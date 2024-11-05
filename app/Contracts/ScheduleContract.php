<?php

namespace App\Contracts;

use App\Http\Requests\GetScheduleByDateRequest;

interface ScheduleContract
{
    function getScheduleForToday();
    function getScheduleByDate(GetScheduleByDateRequest $request);
    function getScheduleId();
}
