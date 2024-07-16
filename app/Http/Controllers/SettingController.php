<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\KitchenSettingRequest;
use App\Services\KitchenSettingService;
use Illuminate\Http\Request;

class SettingController extends CrudController
{
    protected KitchenSettingService $service;
    protected KitchenSettingRequest $Request;
    public function __construct(KitchenSettingService $service,KitchenSettingRequest $Request){
        $this->service=$service;
        $this->Request=$Request;
    }
}
