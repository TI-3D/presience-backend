<?php

namespace App\Http\Controllers;


use App\Contracts\ScheduleContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ScheduleController extends Controller
{
    //
    protected ScheduleContract $scheduleContract;

    public function __construct(ScheduleContract $scheduleContract)
    {
        $this->scheduleContract = $scheduleContract;
    }

    public function getScheduleForToday(){
        $result = $this->scheduleContract->getScheduleForToday();
        return $result;
    }

}
