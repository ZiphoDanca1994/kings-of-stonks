<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\StockTicker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\BaseController as BaseController;

class StockTickerController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'symbol' => 'required',
            'fromDate' => 'date|date_format:Y-m-d|before:tomorrow',
            'toDate' => 'date|date_format:Y-m-d|before:tomorrow',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (isset($request->fromDate) && isset($request->toDate)) {
            if ($request->fromDate > $request->toDate) {
                return $this->sendError('Validation Error.', 'Invalid date range');
            }
        }

        $query = StockTicker::query();

        if (isset($request->symbol)) {
            $stockTickers = ["AAPL","GOOG","SPY","CRM","TSLA"];

            $symbol = strtoupper($request->symbol);

            if (array_search($symbol, $stockTickers) === false) {
                return $this->sendError('Error.', 'Invalid symbol, One stock ticker symbol allowed');
            }

            $query->where('symbol', $symbol);
        }

        if (isset($request->fromDate)) {
            $query->where('date', '>=', $request->fromDate);
        }

        if (isset($request->toDate)) {
            $query->where('date', '<=', $request->toDate);
        }

        if (isset($request->sort) && ($request->sort !== "DESC")) {
            $query->orderBy('date', 'ASC');
        } else {
            $query->orderBy('date', 'DESC');
	}

        $stockTickers = $query->get();

        return $this->sendResponse($stockTickers, 'Stock tickers retrieved successfully.');
    }
}
