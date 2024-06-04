<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\BannerService;

class BannerController extends Controller
{
protected BannerService $service ;
public function __construct(BannerService $bannerService){
    $this->service= $bannerService;
}

}


