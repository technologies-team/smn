<?php


namespace App\Http\Controllers;



use App\Services\AttachmentService;
use App\Http\Requests\Attachment\StoreRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AttachmentController extends CrudController
{
    protected AttachmentService $service;
    protected StoreRequest $storeRequest;

    public function __construct(AttachmentService $service,StoreRequest $storeRequest)
    {
        $this->service = $service;
        $this->storeRequest=$storeRequest;
    }

    /**
     * @throws \Exception
     */
    public function download(string $name): StreamedResponse
    {
        return $this->service->download($name);
    }

}
