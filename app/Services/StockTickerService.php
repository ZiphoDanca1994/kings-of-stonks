<?php

namespace App\Services;

use App\Models\StockTicker;

class StockTickerService
{
    public function retrieveStockTickers($symbols)
    {
        set_time_limit(0);

        $url_info = "https://financialmodelingprep.com/api/v3/quote/" . $symbols . "?apikey=" . env("STOCK_API_KEY");

        $channel = curl_init();

        curl_setopt($channel, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($channel, CURLOPT_HEADER, 0);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($channel, CURLOPT_URL, $url_info);
        curl_setopt($channel, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($channel, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($channel, CURLOPT_TIMEOUT, 0);
        curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);

        $output = curl_exec($channel);

        if (curl_error($channel)) {
            return 'error:' . curl_error($channel);
        } else {
            $outputJSON = json_decode($output);
            return $outputJSON;
        }
    }

    public function storeStockTicker($symbol, $price, $changesPercentage, $date)
    {
        $stockTicker = new StockTicker();
        $stockTicker->symbol = $symbol;
        $stockTicker->price = $price;
        $stockTicker->changesPercentage = $changesPercentage;
        $stockTicker->date = $date;
        $stockTicker->save();
    }
}
