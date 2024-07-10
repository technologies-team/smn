<?php

namespace App\Http\Controllers;

use App\DTOs\SearchQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Responses\SuccessResponse;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CrudController extends Controller
{

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


    public function update(FormRequest $request, int $id): SuccessResponse
    {
        return $this->ok($this->service->save($id, $request->all()));
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): SuccessResponse
    {
        return $this->ok($this->service->create($request->all()));
    }
    /**
     * @throws Exception
     */
    public function delete(int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }    public function destroy(int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }
}
