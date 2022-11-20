<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Http\Requests\TeacherUpdateRegistrationRequest;
use App\Libraries\MyCourse;
use App\Libraries\TeacherPolicy;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Illuminate\Http\Request;

class RoomRegistrationController extends Controller
{
    private $roomRegistration, $policy;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
        $this->policy = new TeacherPolicy();
    }

     public function create(Request $request){
        if(isset($request->filter)){
            $data['myRegistration'] = $this->roomRegistration->filterOfTeacher(auth()->guard('teacher')->id(), $request->filter);
        }
        else{
            $data['myRegistration'] = $this->roomRegistration->getOfTeacher(auth()->guard('teacher')->id());
        }
        $data['room'] = [];
        foreach($data['myRegistration'] as $value){
            $data['room'][$value->id] = $this->roomRegistration->getRoomById($value->id);
        }
        return view('front.teacher.registration_room', $data);
     }

     public function store(TeacherRegistrationRequest $request){
        $collection = $request->except(['_token']);
        $collection['date'] = date('Y-m-d', strtotime($collection['date']));
        $store = $this->roomRegistration->create($collection);

        if($store){
            return back()->with('success', __('message.registration_success'));
        }
        else{
            return back()->with('error', __('message.error'));
        }
         
     }

     public function edit($id){
        $this->policy->roomRegistration($id, auth()->guard('teacher')->id());
        $data = $this->roomRegistration->getById($id);
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        else{
            return response()->json(['status' => 0]);
        }
     }

     public function update(TeacherUpdateRegistrationRequest $request, $id){
        $this->policy->roomRegistration($id, auth()->guard('teacher')->id());
        $data = $this->roomRegistration->getById($id);
        if(!empty($data)){
            $collection = $request->except(['_token', '_method']);
            $collection['date'] = date('Y-m-d', strtotime($request->date));
            $collection['start_time'] = date('H:i', strtotime($request->start_time));
            $collection['end_time'] = date('H:i', strtotime($request->end_time));
            $collection['teacher_id'] = auth()->guard('teacher')->id();
            $this->roomRegistration->update($id, $collection);
            $request->session()->flash('success_edit', __('message.update_success', ['name' => 'đăng ký']));
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 0]);
        }
     }

     public function destroy($id){
        $this->policy->roomRegistration($id, auth()->guard('teacher')->id());
        $delete = $this->roomRegistration->delete($id);
        if($delete){
            return response()->json(['status' => 200]);
        }
        else return response()->json(['status' => 500]);
     }
}
