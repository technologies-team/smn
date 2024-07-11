<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Services\OfferService;
use Exception;

class OfferController extends CrudController
{
    protected OfferService $service ;
    protected OfferRequest $Request;
    public function __construct(OfferService $bannerService){
        $this->service= $bannerService;
    }
    /**
     * @throws Exception
     */
}
