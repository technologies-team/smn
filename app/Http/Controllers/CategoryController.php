<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends CrudController
{
   protected CategoryService $service;
   public function __construct(CategoryService $service){
       $this->service=$service;
   }
}
