<?php

namespace App\Services\ThirdPartyApi;

use App\Factories\ThirdApiQueryFactory;
use Illuminate\Http\Client\Response;

class ParseApiService
{
    public function __construct(
        private readonly HttpApiService $httpApiService,
        private readonly ThirdApiQueryFactory $factory
    )
    {
    }

    public function getPages(string $path, int $limit): int
    {
        $response = $this->httpApiService->getOne($path);
        $data = json_decode($response->body());
        if ($data == null)
        {
            throw new \DomainException("cannot get pages count");
        }
        return (int)ceil($data->meta->total / $limit);
    }
    public function parse(string $path, array $params): void
    {
        $limit = env("DATABASE_LIMIT");
        $this->httpApiService->setParams($params);
        $pages = $this->getPages($path, $limit);
        $this->httpApiService->setLimit($limit);
        for ($page = 1; $page <= $pages; $page++) {
            $this->httpApiService->setPage($page);
            $response = $this->httpApiService->get($path);
            if ($response->ok())
            {
                $data = $this->responseToArray($response);
                $query = $this->factory->build($path);
                $query->insert($data);
            }
            else if ($response->tooManyRequests())
            {
                sleep(10);
                $page--;
            }
        }
    }

    private function responseToArray(Response $response): array
    {
        $data = json_decode($response->body());
        $data = (array)$data->data;
        return array_map(function ($item) {
            return (array)$item;
        }, $data);
    }
}
