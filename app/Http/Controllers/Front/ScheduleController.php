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
        return $this->roomRegistration->getForDate($date)->toArray();
    }

    public function dynamicProgramming($registrations = []){
        $n = count($registrations);
        $num[0] = 1;
        $des[0] = 0;
        for($i = 1; $i < $n; $i++){
            $num_max = 0;
            $key_max = $i;
            for($j = 0; $j < $i; $j++){
                if(($registrations[$j]['period_end_id'] <= $registrations[$i]['period_start_id']) && ($num_max < $num[$j])){
                    $num_max = $num[$j];
                    $key_max = $j;
                }   
            }
            $num[$i] = $num_max + 1;
            $des[$i] = $key_max;
        }
        
        return [$num, $des];
    }

    public function trace($destination = [], $max, $last_index){
            $result = [];
            $max_index = $last_index;
            for($i = $max; $i > 0; $i--){
                array_push($result, $max_index);
                $max_index = $destination[$max_index];
            }
        return $result;
    }

    public function getSchedule($registrations = [], $arr = []){

    }

    public function main(){
        $registrations = $this->getData('2022-08-17');
        [$num, $des] = $this->dynamicProgramming($registrations);
        dd($registrations);
        dd($this->trace($des, max($num), array_search(max($num), $num)));

    }

}
