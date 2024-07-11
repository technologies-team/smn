<?php


namespace App\Http\Controllers;



use App\Services\AttachmentService;
use App\Http\Requests\Attachment\StoreRequest;


class AttachmentController extends CrudController
{
    protected AttachmentService $service;
    protected StoreRequest $storeRequest;

    public function __construct(AttachmentService $service,StoreRequest $storeRequest)
    {
        $this->service = $service;
        $this->storeRequest=$storeRequest;
    }

}
