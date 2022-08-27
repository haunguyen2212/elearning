<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Libraries\Schedule;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $schedule, $room ,$roomRegistration;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        RoomRegistrationRepositoryInterface $roomRegistrationRepository
    )
    {
        $this->room = $roomRepository;
        $this->roomRegistration = $roomRegistrationRepository;
        $this->schedule = new Schedule();
    }

    public function index(){
        $data['list_registration'] = $this->roomRegistration->getAll(20);
        return view('admin.room_registration.index', $data);
    }

    public function create(){
        return view('admin.room_registration.schedule');
    }

    public function error(){
        return view('errors.404');
    }

    public function main(ScheduleRequest $request){
        $period = CarbonPeriod::create($request->from_date, $request->to_date);
        $rooms = $this->room->getDropDown()->toArray();
        asort($rooms);
        [$schedule, $deny] = $this->schedule->getSchedule($request->from_date, $request->to_date);
        return view('admin.room_registration.result', compact('period', 'rooms', 'schedule', 'deny'));
        
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
}
