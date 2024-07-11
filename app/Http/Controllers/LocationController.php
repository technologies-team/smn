<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\updateLocationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\AuthService;
use App\Services\BannerService;
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

