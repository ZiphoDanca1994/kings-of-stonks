<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockTicker>
 */
class StockTickerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'symbol' => fake()->currencyCode,
            'price' => fake()->randomDigit,
            'changesPercentage' => fake()->randomDigit,
            'date' => fake()->date(),
        ];
    }
}
