<?php

namespace App\Repositories;

use App\Models\RoomRegistration;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RoomRegistrationRepository implements RoomRegistrationRepositoryInterface{

    private $room_registration;

    public function __construct(RoomRegistration $room_registration)
    {
        $this->room_registration = $room_registration;
    }

    public function getAll($offset = 10)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('room_registrations.*', DB::raw('teachers.name as teacher_name'))
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'asc')
            ->paginate($offset);
    }

    public function getForDate($date)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->whereDate('date', $date)
            ->select('room_registrations.id', 'purpose', 'date', 'start_time', 'end_time', 'amount', 'status', DB::raw('teachers.name as teacher_name'))
            ->orderBy('end_time', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function create($collection = [], $is_admin = false)
    {
        if($is_admin){
            return $this->room_registration->create([
                'purpose' => $collection['purpose'],
                'teacher_id' => $collection['teacher_id'],
                'amount' => $collection['amount'],
                'date' => $collection['date'],
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
                'status' => $collection['status'] ?? 0,
            ]);
        }
        else{
            return $this->room_registration->create([
                'purpose' => $collection['purpose'],
                'teacher_id' => auth()->guard('teacher')->id(),
                'amount' => $collection['amount'],
                'date' => $collection['date'],
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
            ]);
        }
    }

    public function getOfTeacher($teacher_id, $offset = 10 ,$orderBy = 'desc')
    {
        return $this->room_registration->where('teacher_id', $teacher_id)->orderBy('date', $orderBy)->paginate($offset);
    }

    public function getById($id)
    {
        return $this->room_registration->where('id', $id)->first();
    }

    public function getFullById($id)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->select('room_registrations.id', 'purpose', 'date', 'start_time', 'end_time', 'amount', 'status', DB::raw('teachers.name as teacher_name'))
            ->where('room_registrations.id', $id)->first();
    }

    public function filterOfTeacher($teacher_id ,$value, $offset = [], $orderBy = 'desc')
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        switch($value){
            case 'current':
                return $this->room_registration->where('teacher_id', $teacher_id)
                    ->where(DB::raw('CONCAT(date, " " , start_time)'),'<=', $now)
                    ->where(DB::raw('CONCAT(date, " " , end_time)'),'>=', $now)
                    ->orderBy('date', $orderBy)
                    ->paginate($offset);
                break;
            case 'future':
                return $this->room_registration->where('teacher_id', $teacher_id)
                    ->where(DB::raw('CONCAT(date, " " , start_time)'),'>=', $now)
                    ->orderBy('date', $orderBy)
                    ->paginate($offset);
                break;
            case 'past':
                return $this->room_registration->where('teacher_id', $teacher_id)
                    ->where(DB::raw('CONCAT(date, " " , end_time)'),'<', $now)
                    ->orderBy('date', $orderBy)
                    ->paginate($offset);
                break;
            default:
                return $this->room_registration->where('teacher_id', $teacher_id)
                    ->orderBy('date', $orderBy)
                    ->paginate($offset);
        }
    }

    public function update($id, $collection = [])
    {
        return $this->room_registration->find($id)->update([
            'purpose' => $collection['purpose'],
            'date' => $collection['date'],
            'teacher_id' => $collection['teacher_id'],
            'start_time' => $collection['start_time'],
            'end_time' => $collection['end_time'],
            'amount' => $collection['amount'],
        ]);
    }

    public function delete($id)
    {
        return $this->room_registration->find($id)->delete();
    }

    public function getDataAcceptForDate($date)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->join('room_assignments', 'registration_id', 'room_registrations.id')
            ->where('room_registrations.status', 1)
            ->whereDate('date', $date)
            ->select('room_registrations.id', 'purpose', 'date', 'start_time', 'end_time', 'amount', 'status', 'room_id' ,DB::raw('teachers.name as teacher_name, room_assignments.id as assignment_id'))
            ->orderBy('end_time', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function getDataDenyAndLack($start_date, $end_date)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('room_assignments', 'registration_id', 'room_registrations.id')
            ->whereIn('room_registrations.status', ['-1', '0'])
            ->whereDate('date', '>=' , $start_date)
            ->whereDate('date', '<=', $end_date)
            ->select('room_registrations.id', 'purpose', 'date', 'start_time', 'end_time', 'amount', 'status', 'room_id' ,DB::raw('teachers.name as teacher_name'))
            ->orderBy('end_time', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function getResultForRegistration($id){
        return $this->room_registration->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('room_assignments', 'registration_id', 'room_registrations.id')
            ->where('room_registrations.id', $id)
            ->select('room_registrations.id', 'purpose', 'date', 'start_time', 'end_time', 'amount', 'status', 'room_id' ,DB::raw('teachers.name as teacher_name, room_assignments.id as assignment_id'))
            ->get();
    }

    public function setStatus($id, $status = 0)
    {
        return $this->room_registration->find($id)->update([
            'status' => $status,
        ]);
    }

    public function checkTime($start_time, $end_time, $date, $room_id)
    {
        return $this->room_registration->leftJoin('teachers', 'teacher_id', '=', 'teachers.id')
            ->join('room_assignments', 'registration_id', '=', 'room_registrations.id')
            ->where('room_id', $room_id)
            ->where('status', 1)
            ->where('date', $date)
            ->where(function($q) use ($start_time, $end_time){
                $q->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time])
                    ->orWhereRaw("'".$start_time."' BETWEEN start_time AND end_time")
                    ->orWhereRaw("'".$end_time."' BETWEEN start_time AND end_time");
            })
            ->select('room_registrations.*',DB::raw('teachers.name as teacher_name, room_assignments.id as assignment_id'))
            ->get();
    }
    
}