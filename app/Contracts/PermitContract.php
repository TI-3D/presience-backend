<?php

namespace App\Contracts;

use App\Http\Requests\CurrentPermitRequest;
use App\Http\Requests\PermitAfterRequest;
use App\Http\Requests\PermitBeforeSchedule;
use Illuminate\Http\Request;

interface PermitContract {
    function currentPermit(CurrentPermitRequest $request);
    function permitBeforeSchedule(PermitBeforeSchedule $request);
    function getPermitHistory(Request $request);
    function permitAfter(PermitAfterRequest $request);
}
