<?php

namespace App\Http\Controllers;

use App\Models\StockTicker;
use App\Services\StockTickerService;
use Illuminate\Http\Request;

class StockTickerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $stockTickerSymbols = "AAPL,GOOG,SPY,CRM,TSLA";

        $stockTickers = (new StockTickerService())->retrieveStockTickers($stockTickerSymbols);

        foreach ($stockTickers as $stockTicker) {
            (new StockTickerService())->storeStockTicker(
                $stockTicker->symbol,
                $stockTicker->price,
                $stockTicker->changesPercentage,
                $stockTicker->timestamp
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTicker $stockTicker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockTicker $stockTicker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockTicker $stockTicker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockTicker $stockTicker)
    {
        //
    }
}
