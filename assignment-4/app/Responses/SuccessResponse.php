<?php

namespace App\Responses;

use App\Enum\ResponseType;

class SuccessResponse extends Response
{
    public function __construct(string $message = null) {
        $this->responseType = ResponseType::SUCCESS;
        parent::__construct($message);
    }

    public function __toString()
    {
        return "Info: " . $this->message . " :)";
    }
}