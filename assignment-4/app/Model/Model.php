<?php

namespace App\Model;

use App\Contract\Storage;

class Model 
{
    public function __construct(
        protected Storage $storage
    ) {}
}