<?php

namespace App\Responses;

use App\Enum\ResponseType;

class ErrorResponse extends Response
{
    public function __construct(string $message = null) {
        $this->responseType = ResponseType::ERROR;
        parent::__construct($message);
    }

    public function __toString()
    {
        return "Error: " . $this->message . " :(";
    }
}