<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditScheduleStoreRequest;
use App\Repositories\Interfaces\RoomAssignmentRepositoryInterface;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleEditController extends Controller
{
    private $roomRegistration, $roomAssignment, $teacher, $room;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository,
        RoomAssignmentRepositoryInterface $roomAssignmentRepository,
        TeacherRepositoryInterface $teacherRepository,
        RoomRepositoryInterface $roomRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
        $this->roomAssignment = $roomAssignmentRepository;
        $this->teacher = $teacherRepository;
        $this->room = $roomRepository;
    }
    public function index()
    {
        //
    }

    public function create()
    {
        $data = $this->teacher->getAccountActive();
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data ,'status' => 1]);
    }


    public function store(EditScheduleStoreRequest $request)
    {
        $collection = $request->except(['_token']);
            $collection['date'] = date('Y-m-d H:i:s', strtotime($collection['date']));
            $collection['start_time'] = date('Y-m-d H:i:s', strtotime($collection['start_time']));
            $collection['end_time'] = date('Y-m-d H:i:s', strtotime($collection['end_time']));
            $collection['status'] = 1;
        $check = $this->roomRegistration->checkTime($collection['start_time'], $collection['end_time'], $collection['date'], $request->room_id);
        if($check->count() > 0){
            return response()->json(['message' => '<i class="bi bi-exclamation-circle"></i> Phòng đã được sử dụng', 'status' => 0]);
        }
        if(!$this->room->checkCapacity($request->room_id, $request->amount)){
            return response()->json(['message' => '<i class="bi bi-exclamation-circle"></i> Phòng không đủ chỗ', 'status' => 0]);
        }
        DB::beginTransaction();
        try{
            $roomRegistration = $this->roomRegistration->create($collection, true);
            $collectionAssignment = [
                'registration_id' => $roomRegistration->id,
                'room_id' => $request->room_id,
            ];
            $this->roomAssignment->create($collectionAssignment);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['info'] = $this->roomAssignment->getFullById($id);
        $data['rooms'] = $this->room->getDropDownForCapacity($data['info']->amount);
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        return response()->json(['status' => 0]);
    }


    public function update(Request $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        $info = $this->roomAssignment->getFullById($id);
        DB::beginTransaction();
        try{
            $olds = $this->roomRegistration->checkTime($info->start_time, $info->end_time, $info->date, $request->room_id);
            foreach($olds as $key => $value){
                if($value->start_time == $info->end_time || $value->end_time == $info->start_time){
                    unset($olds[$key]);
                }
            }
            foreach($olds as $key => $value){
                $count = $this->roomAssignment->countRegistration($value->id);
                if($count == 1){
                    $this->roomRegistration->setStatus($value->id, '-1');
                    $this->roomAssignment->setNullRoom($value->assignment_id);
                }
                else{
                    $this->roomAssignment->delete($value->assignment_id);
                }
            }
            
            $this->roomAssignment->update($id, $collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }


    public function destroy($id)
    {
        $registration = $this->roomAssignment->getById($id);
        if(empty($registration)){
            return response()->json(['status' => 0]);
        }
        $registration_id = $registration->registration_id;

        DB::beginTransaction();
        try{
            $count = $this->roomAssignment->countRegistration($registration_id);
            if($count == 1){
                $this->roomRegistration->setStatus($registration_id, '-1');
                $this->roomAssignment->setNullRoom($id);
            }
            else{
                $this->roomAssignment->delete($id);
            }
            DB::commit();
            return response()->json(['data' => $id, 'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }

    }

    public function assignEdit($registration_id){
        $data['info'] = $this->roomRegistration->getFullById($registration_id);
        $data['rooms'] = $this->room->getDropDownAsc();
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function checkUpdate($registration_id, Request $request){
        $info = $this->roomRegistration->getFullById($registration_id);
        if(empty($info)){
            return response()->json(['status' => 0]);
        }
        $data = $this->roomRegistration->checkTime($info->start_time, $info->end_time, $info->date, $request->room_id);
        foreach($data as $key => $value){
            if($value->start_time == $info->end_time || $value->end_time == $info->start_time){
                unset($data[$key]);
            }
        }
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function checkAssign($registration_id, Request $request){
        $info = $this->roomRegistration->getFullById($registration_id);
        if(empty($info)){
            return response()->json(['status' => 0]);
        }
        $data = $this->roomRegistration->checkTimeForRooms($info->start_time, $info->end_time, $info->date, $request->room_id);
        foreach($data as $key => $value){
            if($value->start_time == $info->end_time || $value->end_time == $info->start_time){
                unset($data[$key]);
            }
        }
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function assignUpdate($registration_id, Request $request){
        $collection = $request->except(['_token', '_method']);
        $info = $this->roomRegistration->getFullById($registration_id);
        DB::beginTransaction();
        try{
            $olds = $this->roomRegistration->checkTimeForRooms($info->start_time, $info->end_time, $info->date, $request->room_id);
            foreach($olds as $key => $value){
                if($value->start_time == $info->end_time || $value->end_time == $info->start_time){
                    unset($olds[$key]);
                }
            }
            foreach($olds as $key => $value){
                $count = $this->roomAssignment->countRegistration($value->id);
                if($count == 1){
                    $this->roomRegistration->setStatus($value->id, '-1');
                    $this->roomAssignment->setNullRoom($value->assignment_id);
                }
                else{
                    $this->roomAssignment->delete($value->assignment_id);
                }
            }

            $count = $this->roomAssignment->countRegistration($registration_id);
            if($count > 0){
                $this->roomAssignment->deleteByRegistration($registration_id);
            }

            foreach($request->room_id as $value){
                $collection['registration_id'] = $registration_id;
                $collection['room_id'] = $value;
                $this->roomAssignment->create($collection);
            }

            $this->roomRegistration->setStatus($registration_id, 1);

            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
