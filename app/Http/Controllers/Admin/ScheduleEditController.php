<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoomAssignmentRepositoryInterface;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleEditController extends Controller
{
    private $roomRegistration, $roomAssignment;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository,
        RoomAssignmentRepositoryInterface $roomAssignmentRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
        $this->roomAssignment = $roomAssignmentRepository;
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = $this->roomRegistration->getResultForRegistration($id);
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        return response()->json(['status' => 0]);
    }


    public function update(Request $request, $id)
    {
        //
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
