<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends CrudController
{
   protected CategoryService $service;
   public function __construct(CategoryService $service,CategoryRequest $Request){
       $this->service=$service;
       $this->Request=$Request;
   }
    protected CategoryRequest $Request;

}
