<?php

namespace App\Contracts;

use App\Http\Requests\CurrentPermitRequest;
use App\Http\Requests\PermitBeforeSchedule;

interface PermitContract {
    function currentPermit(CurrentPermitRequest $request);
    function permitBeforeSchedule(PermitBeforeSchedule $request);
}
