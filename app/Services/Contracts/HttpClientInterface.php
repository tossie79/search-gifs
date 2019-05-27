<?php
declare(strict_types=1);
namespace App\Services\Contracts;

interface HttpClientInterface
{
    public function createConnection();
}

