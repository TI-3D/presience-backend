<?php

namespace App\Http\Controllers;


use App\Contracts\ScheduleContract;
use App\Http\Requests\GetScheduleByDateRequest;
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

    public function getScheduleByDate(GetScheduleByDateRequest $request){
        $result = $this->scheduleContract->getScheduleByDate($request);
        return $result;
    }

    public function getSchedule($group_id){
        $result =$this->scheduleContract->getScheduleId($group_id);
        return $result;
    }

}
