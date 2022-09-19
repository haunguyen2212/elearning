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
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token']);
            $collection['date'] = date('Y-m-d H:i:s', strtotime($collection['date']));
            $collection['start_time'] = date('Y-m-d H:i:s', strtotime($collection['start_time']));
            $collection['end_time'] = date('Y-m-d H:i:s', strtotime($collection['end_time']));
            $collection['status'] = 1;
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
        $data['rooms'] = $this->room->getDropDownAsc();
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        return response()->json(['status' => 0]);
    }


    public function update(Request $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try{
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
}
