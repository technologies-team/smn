<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\updateLocationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\AuthService;
use App\Services\BannerService;
use App\Services\LocationService;

class LocationController extends Controller
{
    private LocationService $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param SearchRequest $request
     * @return SuccessResponse
     * @throws \Exception
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
     * @throws \Exception
     */
    public function show(int $id): SuccessResponse
    {
        return $this->ok($this->service->get($id));
    }

    /**
     * @throws \Exception
     */
    public function updateAll(updateLocationRequest $request, int $id): SuccessResponse
    {
        return $this->ok($this->service->save($id, $request->all()));
    }

    /**
     * @throws \Exception
     */
    public function storeAll(StoreLocationRequest $request): SuccessResponse
    {
        return $this->ok($this->service->create($request->all()));
    }
    public function destroy( int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }
}
