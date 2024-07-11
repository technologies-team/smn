<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;

use App\Services\LocationService;

class LocationController extends CrudController
{
    protected LocationService $service;
    protected LocationRequest $Request;

    public function __construct(LocationService $service,LocationRequest $Request)
    {
        $this->service = $service;
        $this->Request = $Request;
    }


}

