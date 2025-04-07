<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>fake() ->numberBetween(1,3),
            'store_id' =>fake() ->numberBetween(1,20)
        ];
    }
}
/*
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //会員ID
            $table->foreignId('store_id')->constrained()->cascadeOnDelete(); //店舗ID
*/