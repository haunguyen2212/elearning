<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $schedule;

    public function __construct()
    {
        $this->schedule = new Schedule();
    }

    public function main(){
        dd($this->schedule->getSchedule('2022-08-19', '2022-08-21'));
    }

}
