<?php

namespace App\Console\Commands;

use App\Http\Controllers\StockTickerController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class StoreStockTickers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:stock-tickers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To store retrieved stock tickers API';

    /**
     * Execute the console command.
     */
    public function handle(Request $request)
    {
        (new StockTickerController())->store($request);
    }
}
