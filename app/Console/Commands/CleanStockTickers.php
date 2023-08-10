<?php

namespace App\Console\Commands;

use App\Models\StockTicker;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanStockTickers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:stock-tickers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleting stock tickers that are older than 60 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stockTickers = StockTicker::whereDate('date','<', Carbon::now()->subDays(60))->get();

        foreach ($stockTickers as $stockTicker) {
            $stockTicker->delete();
        }
    }
}
