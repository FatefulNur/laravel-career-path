<?php

namespace App\Responses;

use App\Enum\ResponseType;

class Response 
{
    protected ?string $message;
    protected ResponseType $responseType;

    public function __construct(string $message = null) {
        $this->message = $message;
    }

    public function getType(): ResponseType
    {
        return $this->responseType;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}