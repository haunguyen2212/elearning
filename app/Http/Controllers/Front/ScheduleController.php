<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $roomRegistration;

    public function __construct(
        RoomRegistrationRepositoryInterface $roomRegistrationRepository
    )
    {
        $this->roomRegistration = $roomRegistrationRepository;
    }

    public function getData($date){
        return $this->roomRegistration->getForDate($date);
    }

    public function schedule(){
        $now = Carbon::now()->format('Y-m-d');
        $registrations = $this->getData($now);
        $collection = collect();
        $collection->push($registrations[8]);
        $collection->push($registrations[1]);
        dd($collection);
        //dd($registrations->toArray());
    }

}
