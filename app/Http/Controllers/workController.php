<?php

namespace App\Http\Controllers;

use App\Services\ThirdPartyApi\ParseApiService;
use Carbon\Carbon;

class workController extends Controller
{
    public function __construct(private readonly ParseApiService $service)
    {
    }

    public function sales()
    {
        $params = [
            "dateFrom" => "0001-01-01",
            "dateTo" => Carbon::now()->toDateString(),
            "page" => "1",
            "key" => env("DATABASE_KEY"),
            "limit" => 1,
        ];
        $this->service->parse("sales", $params);
    }

    public function incomes()
    {
        $params = [
            "dateFrom" => "0001-01-01",
            "dateTo" => Carbon::now()->toDateString(),
            "page" => "1",
            "key" => env("DATABASE_KEY"),
            "limit" => 1,
        ];
        $this->service->parse("incomes", $params);
    }

    public function stocks()
    {
        $params = [
            "dateFrom" => Carbon::now()->toDateString(),
            "dateTo" => "",
            "page" => "1",
            "key" => env("DATABASE_KEY"),
            "limit" => 1,
        ];
        $this->service->parse("stocks", $params);
    }

    public function orders()
    {
        $params = [
            "dateFrom" => "0001-01-01",
            "dateTo" => Carbon::now()->toDateString(),
            "page" => "1",
            "key" => env("DATABASE_KEY"),
            "limit" => 1,
        ];
        $this->service->parse("orders", $params);
    }
}
