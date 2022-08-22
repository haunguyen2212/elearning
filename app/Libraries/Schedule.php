<?php

namespace App\Libraries;

use Carbon\CarbonPeriod;

class Schedule{

    protected $room, $roomRegistration;

    public function __construct()
    {
        $this->room = app('App\Repositories\Interfaces\RoomRepositoryInterface');
        $this->roomRegistration = app('App\Repositories\Interfaces\RoomRegistrationRepositoryInterface');
    }

    public function getData($date){
        return $this->roomRegistration->getForDate($date)->toArray();
    }

    public function dynamicProgramming($registrations = []){
        $n = count($registrations);
        $total[0] = 1;
        $des[0] = 0;
        for($i = 1; $i < $n; $i++){
            $total_max = 0;
            $key_max = $i;
            for($j = 0; $j < $i; $j++){
                if(($registrations[$j]['end_time'] <= $registrations[$i]['start_time']) && ($total_max <= $total[$j])){
                    $total_max = $total[$j];
                    $key_max = $j;
                }   
            }
            $total[$i] = $total_max + 1;
            $des[$i] = $key_max;
        }
        
        return [$total, $des];
    }

    public function findMaxKey($arr = [], $value){
        $n = count($arr);
        for($i = $n -1; $i >= 0; $i--){
            if($arr[$i] == $value)
                return $i;
        }
        return -1;
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

    public function getFullInfo($registrations= [], $trace = []){
        $info = [];
        $trace = array_reverse($trace); 
        foreach($trace as $value){
            array_push($info, $registrations[$value]); 
        }
        return $info;
    }

    public function filterByAmount($arr = [], $amount){
        foreach($arr as $key => $value){
            if($arr[$key]['amount'] > $amount)
                unset($arr[$key]);
        }
        $result = array_values($arr);
        return $result;
    }

    public function deleteKey($arr = [], $values = []){
        if(empty($values))
            return $arr;
        foreach($values as $value){   
            unset($arr[array_search($value, $arr)]);
        }
        $result = array_values($arr);
        return $result;
    }

    public function getSchedule($from_date,  $to_date){
        $schedule = [];
        $rooms = $this->room->getDropDown();
        $period = CarbonPeriod::create($from_date, $to_date);
        foreach($period as $date_index => $date){
            $registrations = $this->getData($date);
            foreach($rooms as $room_index => $room){
                $arr = [];
                $filter = $this->filterByAmount($registrations, $room->capacity);
                if(empty($filter)){
                    $schedule[$date_index][$room_index] = [];
                    continue;
                }
                [$total, $des] = $this->dynamicProgramming($filter);
                $last_index = $this->findMaxKey($total, max($total));
                $trace = $this->trace($des, max($total), $last_index);
                $arr[$room_index] = $this->getFullInfo($filter, $trace);
                $schedule[$date_index][$room_index] = $arr[$room_index];
                $registrations = $this->deleteKey($registrations, $arr[$room_index]);
            }
            
        }
        
        return $schedule;
    }

    // public function getSchedule($from_date,  $to_date){
    //     $schedule = [];
        
    //     $period = CarbonPeriod::create($from_date, $to_date);
    //     foreach($period as $key => $date){
    //         $registrations = $this->getData($date);
    //         if(empty($registrations)){
    //             $schedule[$key] = [];
    //             continue;
    //         }
    //         [$total, $des] = $this->dynamicProgramming($registrations);
    //         $last_index = $this->findMaxKey($total, max($total));
    //         $trace = $this->trace($des, max($total), $last_index);
    //         $schedule[$key] = $this->getFullInfo($registrations, $trace);
    //     }
        
    //     dd($schedule);

    // }

}