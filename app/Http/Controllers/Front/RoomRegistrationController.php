<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Illuminate\Http\Request;

class RoomRegistrationController extends Controller
{
    private $roomRegistration;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
    }

     public function create(){
        $data['myRegistration'] = $this->roomRegistration->getOfTeacher(auth()->guard('teacher')->id());
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

     public function destroy($id){
        $delete = $this->roomRegistration->delete($id);
        if($delete){
            return response()->json(['status' => 200]);
        }
        else return response()->json(['status' => 500]);
     }
}
