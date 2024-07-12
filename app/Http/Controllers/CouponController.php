<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Http\Requests\OfferRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\CouponService;
use Exception;

class CouponController extends Controller
{
    protected CouponService $service ;
    protected OfferRequest $Request;
    public function __construct(CouponService $bannerService){
        $this->service= $bannerService;
    }
    public function apply(CouponRequest $request): SuccessResponse
    {
        return $this->ok($this->service->apply($request->all()));
    }

    /**
     * @throws Exception
     */
    public function remove(): SuccessResponse
    {
        return $this->ok($this->service->removeCoupon());
    }
}
