<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Services\CouponService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends CrudController
{
    protected NotificationService $service;
    protected OfferRequest $Request;

    public function __construct(NotificationService $bannerService)
    {
        $this->service = $bannerService;
    }

}
