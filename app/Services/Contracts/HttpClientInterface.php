<?php
declare(strict_types=1);
namespace App\Services\Contracts;

interface HttpClientInterface
{
    public function getConnectionUrl():string;
    public function getSearchResults(string $query):array;
    public function getClient();
    public function getApiKey():string;
}
