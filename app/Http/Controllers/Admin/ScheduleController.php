<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegistrationRequest;
use App\Http\Requests\ScheduleRequest;
use App\Libraries\Schedule;
use App\Models\RoomAssignment;
use App\Models\RoomRegistration;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    private $schedule, $room ,$roomRegistration, $teacher;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        RoomRegistrationRepositoryInterface $roomRegistrationRepository,
        TeacherRepositoryInterface $teacherRepository
    )
    {
        $this->room = $roomRepository;
        $this->roomRegistration = $roomRegistrationRepository;
        $this->teacher = $teacherRepository;
        $this->schedule = new Schedule();
    }

    public function index(Request $request){
        if(isset($request->filter)){
            $data['list_registration'] = $this->roomRegistration->filter($request->filter, 20);
            $data['list_registration']->appends(['filter' => $request->filter]);
        }
        else{
            $data['list_registration'] = $this->roomRegistration->getAll(20);
        }
        
        return view('admin.room_registration.index', $data);
    }

    public function create(){
        return view('admin.room_registration.schedule');
    }

    public function error(){
        return view('errors.404');
    }

    public function handleSchedule(ScheduleRequest $request){
        $data['period'] = CarbonPeriod::create($request->from_date, $request->to_date)->toArray();
        $data['rooms'] = $this->room->getDropDown()->toArray();
        [$data['schedule'], $data['deny']] = $this->schedule->getSchedule($request->from_date, $request->to_date);
        //dd($data['deny']);
        DB::beginTransaction();
        try{
            foreach($data['schedule'] as $date){
                foreach($date as $room_index => $room){
                    if($room == []) continue;
                    foreach($room as $value){
                        $old = RoomAssignment::where('registration_id', $value['id'])->count();
                        if($old > 0){
                            RoomRegistration::find($value['id'])->update(['status' => 0]);
                            RoomAssignment::where('registration_id', $value['id'])->delete();
                        }
                        RoomRegistration::find($value['id'])->update(['status' => 1]);
                        RoomAssignment::create([
                            'registration_id' => $value['id'],
                            'room_id' => $data['rooms'][$room_index]['id'],
                        ]);
                    }
                    
                }
            }

            foreach($data['deny'] as $date){
                if($date == []) continue;
                foreach($date as $value){      
                    $old = RoomAssignment::where('registration_id', $value['id'])->count();
                    if($old > 0){
                        RoomRegistration::find($value['id'])->update(['status' => 0]);
                        RoomAssignment::where('registration_id', $value['id'])->delete();
                    }
                    RoomRegistration::find($value['id'])->update(['status' => '-1']);
                    RoomAssignment::create([
                        'registration_id' => $value['id'],
                        'room_id' => NULL,
                    ]);
                }
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
        }
        
        if ($request->session()->exists('schedule')) {
            $request->session()->forget('schedule');
        }
        $request->session()->put('schedule', $data);
        return redirect()->route('schedule.result.show');
    }

    public function showResult(){
        if (!session()->exists('schedule')) {
            return redirect()->route('schedule.create');
        }
        return view('admin.room_registration.result');
    }

    public function printDocx(Request $request){
        if(isset($request->content)){
            header('Content-type: application/vnd.ms-word');
            header('Content-Disposition: attachment;Filename=Xep-lich-'.rand().".docx");
            header('Pragma: no-cache');
            header('Expires: 0');
            echo $request->content;
        }
    }

    public function createRegistration(){
        $data['teachers'] = $this->teacher->getAccountActive();
        return view('admin.room_registration.registration', $data);
    }

    public function storeRegistration(AdminRegistrationRequest $request){
        $collection = $request->except(['_token']);
        $collection['date'] = date('Y-m-d', strtotime($collection['date']));
        $store = $this->roomRegistration->create($collection, true);
        if($store){
            return back()->with('success', __('message.registration_success'));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

}
