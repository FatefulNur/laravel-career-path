<?php

namespace App\Contract;

interface Storage
{
    public function load(string $model): array;
    public function store(string $model, array $data): void;
}