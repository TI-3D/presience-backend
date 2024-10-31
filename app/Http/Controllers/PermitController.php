<?php

namespace App\Http\Controllers;

use App\Contracts\PermitContract;
use App\Http\Requests\CurrentPermitRequest;
use App\Http\Requests\PermitBeforeSchedule;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    //
    protected PermitContract $permitContract;

    public function __construct(PermitContract $permitContract)
    {
        $this->permitContract = $permitContract;
    }

    function storeCurrentPermit(CurrentPermitRequest $request){
        $result = $this->permitContract->currentPermit($request);
        return $result;
    }
    function permitBeforeSchedule(PermitBeforeSchedule $request)
    {
        $result = $this->permitContract->permitBeforeSchedule($request);
        return $result;
    }


}
