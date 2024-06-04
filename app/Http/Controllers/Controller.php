<?php

namespace App\Http\Controllers;

use App\DTOs\Result;
use App\DTOs\SearchQuery;

use App\Http\Requests\SearchRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JetBrains\PhpStorm\NoReturn;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


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
    public function update( $request, int $id): SuccessResponse
    {
        return $this->ok($this->service->save($id, $request->all()));
    }

    /**
     * @throws \Exception
     */
    public function store( $request): SuccessResponse
    {
        return $this->ok($this->service->create($request->all()));
    }

    /**
     * @throws \Exception
     */
    public function destroy(int $id): SuccessResponse
    {
        return $this->ok($this->service->delete($id));
    }
    /**
     * echo
     */
    protected function echo(string $key): string {
        return $key;
    }
    /**
     * ok
     */
    protected function ok(Result $result): SuccessResponse
    {
        return new SuccessResponse($result);
    }
    /**
     * error
     */
    #[NoReturn] protected function error(string $message, int $status = 400): ErrorResponse
    {
        return new ErrorResponse($message, $status);

    }

}
