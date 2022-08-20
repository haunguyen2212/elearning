<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        dd($data['list_registration']);
        return view('admin.room_registration.index', $data);
    }

    public function main(){
        dd($this->schedule->getSchedule('2022-08-19', '2022-08-21'));
    }
}
