<?php

namespace App\Contracts;

use App\Http\Requests\CurrentPermitRequest;

interface PermitContract {
    function currentPermit(CurrentPermitRequest $request);
}
