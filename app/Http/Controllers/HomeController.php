<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Requests\SearchRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\HomeService;
use Exception;

class HomeController extends Controller
{
    private HomeService $service;

    public function __construct(HomeService $service)
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
        return $this->ok($this->service->index(SearchQuery::fromJson($request->all())));
    }

    /**
     * @throws Exception
     */
    public function search(SearchRequest $request): SuccessResponse
    {
        return $this->ok($this->service->search(SearchQuery::fromJson($request->all())));
    }    public function kitchenHome(SearchRequest $request): SuccessResponse
    {
        return $this->ok($this->service->kitchenHome(SearchQuery::fromJson($request->all())));
    }
}
