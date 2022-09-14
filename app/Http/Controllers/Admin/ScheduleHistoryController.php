<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\RoomRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ScheduleHistoryController extends Controller
{

    private $roomRegistration, $room;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository,
        RoomRepository $roomRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
        $this->room = $roomRepository;
    }
    
    public function index(Request $request){
        $start = $request->start ?? Carbon::now()->addWeek()->startOfWeek()->format('Y-m-d');
        $end = $request->end ?? Carbon::now()->addWeek()->endOfWeek()->format('Y-m-d');
        $data['periods'] = CarbonPeriod::create($start, $end)->toArray();
        $data['rooms'] = $this->room->getDropDown()->toArray();
        $data['schedule'] = [];
        foreach($data['periods'] as $date){
            $item = $date->format('Y-m-d');
            $data['schedule'][$item] = $this->roomRegistration->getDataAcceptForDate($item);
        }
        return view('admin.room_registration.history', $data);
    }
}
