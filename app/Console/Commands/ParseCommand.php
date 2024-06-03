<?php

namespace App\Console\Commands;

use App\Services\ThirdPartyApi\ParseApiService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mode = $this->choice("What's endpoint you want to parse", ["sales", "orders", "stocks", "incomes", "all"]);
        $params = [
            "dateFrom" => "0001-01-01",
            "dateTo" => Carbon::now()->toDateString(),
            "page" => "1",
            "key" => env("DATABASE_KEY"),
            "limit" => 1,
        ];
        switch ($mode) {
            case "sales":
            case "orders":
            case "incomes":
                $this->parse($mode, $params);
                break;
            case "stocks":
                $params["dateFrom"] = Carbon::now()->toDateString();
                $params["dateTo"] = "";
                $this->parse($mode, $params);
                break;
            case "all":
                $this->info("Start parse endpoint: $mode");
                $this->parse("sales", $params);
                $this->parse("orders", $params);
                $this->parse("incomes", $params);
                $params["dateFrom"] = Carbon::now()->toDateString();
                $params["dateTo"] = "";
                $this->parse("stocks", $params);
                $this->info("Parse endpoint: all complete");
                break;
        }
    }

    private function parse(string $mode, array $params)
    {
        $this->info("Start parse endpoint: $mode");
        (app(ParseApiService::class))->parse($mode, $params);
        $this->info("Parse endpoint complete");
    }
}
