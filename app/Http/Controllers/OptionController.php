<?php

namespace App\Http\Controllers;
use App\Http\Requests\OptionRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\OptionService;
use Exception;

class OptionController extends CrudController
{
    protected OptionService $service;
    protected OptionRequest $Request;
    public function __construct(OptionService $service,OptionRequest $Request)
    {
        $this->service=$service;
        $this->Request=$Request;
    }
    /**
     * Display a listing of the resource.
     *
     * @param SearchRequest $request
     * @return SuccessResponse
     * @throws Exception
     */


}
