<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredientRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends CrudController
{
   protected CategoryService $service;
   public function __construct(CategoryService $service,StoreIngredientRequest $storeRequest){
       $this->service=$service;
       $this->storeRequest=$storeRequest;
   }
    protected StoreIngredientRequest $storeRequest;

}
