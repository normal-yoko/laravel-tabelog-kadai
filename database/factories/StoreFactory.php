<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => fake()->name(),
            'category_id' =>fake() ->numberBetween(1,7),
            'picture' => '',
            'description' => fake()->realText(),  //説明
            'under_price' => fake()->numberBetween(500,900), //価格帯(下限)
            'upper_price' => fake()->numberBetween(1000,10000), //価格帯(上限)
            'open_time' => '10:00', //営業時間(開店)
            'closed_time' => '22:00',  //営業時間(閉店)
            'postal_code' => fake()->postcode(),  //郵便番号
            'address' => fake()->address(),  //住所
            'phone' => fake()->phoneNumber(), //電話番号
            'closed_day' => '火曜日'  //定休日
        ];
    }
}
