<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\TagRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\TagService;
use Exception;

class TagController extends CrudController
{
    protected TagService $service;
    protected TagRequest $Request;
    public function __construct( TagService $service,TagRequest $Request){
        $this->service=$service;
        $this->Request=$Request;
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


    /**
     * @throws Exception
     */

    /**
     * @throws Exception
     */
    public function delete(int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }
}
