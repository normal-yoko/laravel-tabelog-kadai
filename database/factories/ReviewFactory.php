<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            'star_count' =>fake() ->numberBetween(0,5),
            'comment' =>fake() ->realText(100)

        ];
    }
}
/*
            $table->integer('star_count')->unsigned(); //星の数
            $table->text('comment');  //コメント
*/