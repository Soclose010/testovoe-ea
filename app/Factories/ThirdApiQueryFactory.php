<?php

namespace App\Factories;

use App\Models\Income;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;

class ThirdApiQueryFactory
{
    public function build(string $name): ?Builder
    {
        $query = null;
        switch ($name) {
            case "sales":
                $query = Sale::query();
                break;
            case "orders":
                $query = Order::query();
                break;
            case "incomes":
                $query = Income::query();
                break;
            case "stocks":
                $query = Stock::query();
                break;
        }

        return $query;
    }
}
