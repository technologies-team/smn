<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use App\Services\FeedBackService;
use Illuminate\Http\Request;

class FeedBackController extends CrudController
{
    protected FeedBackService $service;
    protected FeedBackRequest $Request;
    public function __construct(FeedBackService $service,FeedBackRequest $Request){
        $this->service=$service;
        $this->Request=$Request;

    }
}
