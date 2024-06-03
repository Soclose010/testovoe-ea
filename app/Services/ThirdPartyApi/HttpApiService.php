<?php

namespace App\Services\ThirdPartyApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HttpApiService
{
    private array $params;
    public function setParams(array $params): void
    {
        $this->params = $params;
    }
    public function get(string $path): Response
    {
        $url = "http://" . env("DATABASE_HOST") . "/api/$path";
        return Http::get($url, $this->params);
    }

    public function getOne(string $path): Response
    {
        $this->setLimit(1);
        $url = "http://" . env("DATABASE_HOST") . "/api/$path";
        return Http::get($url, $this->params);
    }

    public function setLimit(int $limit): void
    {
        $this->params["limit"] = $limit;
    }

    public function setPage(int $page)
    {
        $this->params["page"] = $page;
    }
}
