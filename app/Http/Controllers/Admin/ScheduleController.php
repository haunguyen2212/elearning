<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Libraries\Schedule;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $schedule, $roomRegistration;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository
    )
    {
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
        $schedule = $this->schedule->getSchedule($request->from_date, $request->to_date);
        print_r($schedule);
    }
}
