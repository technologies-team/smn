<?php


namespace App\Http\Controllers;



use App\Http\Requests\Attachment\UpdateRequest;
use App\Http\Requests\AttachmentRequest;
use App\Services\AttachmentService;
use App\Http\Requests\Attachment\StoreRequest;
use Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AttachmentController extends CrudController
{
    protected AttachmentService $service;
    protected AttachmentRequest $Request;

    public function __construct(AttachmentService $service,AttachmentRequest $Request)
    {
        $this->service = $service;
        $this->Request=$Request;
    }

    /**
     * @throws Exception
     */
    public function download(string $name): StreamedResponse
    {
        return $this->service->download($name);
    }

}
