<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends CrudController
{
    protected TagService $service;
    public function __construct( TagService $service){
        $this->service=$service;
    }
}
