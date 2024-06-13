<?php

namespace App\DTOs;

class Result
{
    /**
     *
     */
    public int $statusCode;

    /**
     *
     */
    public string $message;
    /**
     *
     */

    protected $success;

    /**
     *
     */
    public mixed $data;

    public function __construct($data, string $message = '', int $statusCode = 0, $success = 'true')
    {
        $this->data = $data;
        $this->message = $message;
        $this->success = $success;
        $this->statusCode = $statusCode;
    }

    public function success(): bool
    {
        //  return ["data" => $this->data, "message" => $this->message, "statusCode" => $this->statusCode];
        return $this->success;
    }

    public function getMessage(): bool
    {
        if ($this->message) {
            return true;
        }
        return false;
    }
}
