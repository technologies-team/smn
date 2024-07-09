<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\IngredientService;
use App\Services\OptionService;
use Exception;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected OptionService $service;
    public function __construct(OptionService $service)
    {
        $this->service=$service;
    }
    /**
     * Display a listing of the resource.
     *
     * @param SearchRequest $request
     * @return SuccessResponse
     * @throws Exception
     */
    public function index(SearchRequest $request): SuccessResponse
    {
        return $this->ok($this->service->search(SearchQuery::fromJson($request->all())));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SuccessResponse
     * @throws Exception
     */
    public function show(int $id): SuccessResponse
    {
        return $this->ok($this->service->get($id));
    }


    public function updateAll(StoreIngredientRequest $request, int $id): SuccessResponse
    {
        return $this->ok($this->service->save($id, $request->all()));
    }

    /**
     * @throws Exception
     */
    public function storeAll(StoreIngredientRequest $request): SuccessResponse
    {
        return $this->ok($this->service->create($request->all()));
    }
    /**
     * @throws Exception
     */
    public function delete(int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }
}
