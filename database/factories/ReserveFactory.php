<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>fake() ->numberBetween(1,5),
            'store_id' =>fake() ->numberBetween(1,30),
            'reservation_date' =>fake() ->date(),
            'headcount' =>fake() ->numberBetween(1,4)


        ];
    }
}
/*
            $table->string('reservation_date')->default(''); //予約日
            $table->integer('headcount')->unsigned(); //人数
*/