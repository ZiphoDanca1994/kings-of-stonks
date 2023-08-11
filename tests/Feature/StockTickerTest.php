<?php

namespace Tests\Feature;

use App\Models\User;
use Response;
use Laravel\Passport\Passport;
use App\Models\StockTicker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockTickerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Testing if stock ticker can be saved
     */
    public function test_can_stock_ticker_be_saved()
    {
        StockTicker::factory(5)->create();

        $this->assertEquals(5, StockTicker::all()->count());
    }

    /**
     * Testing if the stock ticker is returned in correct format
     */

    public function test_stock_ticker_api()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $response = $this->json('GET', '/api/v4/quote', [
            'symbol' => 'AAPL',
            'fromDate' => '2023-08-10',
            'toDate' => '2023-08-10',
            'sort' => 'ASC',
        ]);

        $response->assertStatus(200);
    }
}
