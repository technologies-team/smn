<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\IngredientService;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class IngredientController extends CrudController
{
    protected IngredientService $service;

}
