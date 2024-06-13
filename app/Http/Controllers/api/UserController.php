<?php

namespace App\Http\Controllers\api;

use App\DTOs\Result;
use App\DTOs\SearchQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use JetBrains\PhpStorm\NoReturn;
use phpseclib3\File\ASN1\Maps\ReasonFlags;
use Throwable;

class UserController extends BaseController
{
    public UserService $service;

    public function __construct(UserService  $service)
    {
        $this->service = $service;
    }

    /**
     * activate
     *
     * @param int $id
     * @return SuccessResponse
     * @throws Throwable
     */
    public function activate(int $id): SuccessResponse
    {
        return $this->ok($this->service->activate($id));
    }

    /**
     * suspend
     *
     * @param int $id
     * @return SuccessResponse
     * @throws Throwable
     */
    public function suspend(int $id): SuccessResponse
    {
        return $this->ok($this->service->suspend($id));
    }

    /**
     * register
     *
     * @param RegisterRequest $request
     * @return SuccessResponse
     * @throws Exception
     */
    public function register(RegisterRequest $request): SuccessResponse
    {
        return $this->ok($this->service->register($request->all()));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return SuccessResponse
     * @throws Exception
     */
    public function update(UpdateUserRequest $request, int $id): SuccessResponse
    {
        return $this->ok($this->service->save($id, $request->all()));
    }
    public function delete( ): SuccessResponse
    {
        return $this->ok($this->service->delete());
    }
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
