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
        $now = Carbon::now()->subDay()->format('Y-m-d');
        $registrations = $this->getData($now);
        $collection = collect();
        //dd($collection);
        dd($registrations->toArray());
    }

    public function dynamicProgramming(){
        $now = Carbon::now()->subDay()->format('Y-m-d');
        $registrations = $this->getData($now);
        $n = 10;
        $L[0] = 1;
        $T[0] = 0;
        for($i = 1; $i < $n; $i++){
            $LMax = 0;
            $jMax = $i;
            for($j = 0; $j < $i; $j++){
                if((int)$registrations[$j]->period_end_id <= (int)$registrations[$i]->period_start_id && $LMax < $L[$j]){
                    $LMax = $L[$j];
                    $jMax = $j;
                }   
            }
            $L[$i] = $LMax + 1;
            $T[$i] = $jMax;
        }
        
      dd($L);
      

    }

}
