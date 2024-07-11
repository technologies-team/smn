<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Services\CouponService;
use App\Services\FoodService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected CouponService $service ;
    protected OfferRequest $Request;
    public function __construct(CouponService $bannerService){
        $this->service= $bannerService;
    }
}
