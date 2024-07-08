<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\IngredientService;
use Illuminate\Http\Request;

class IngredientController extends CrudController
{
    protected IngredientService $service;
    public function __construct(IngredientService $service)
    {
        $this->service=$service;
    }
}
