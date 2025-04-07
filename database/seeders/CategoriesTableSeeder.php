<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_names = [
            '和食','中華','イタリアン','エスニック','ラーメン','うどん','そば' 
        ];

        foreach($category_names as $category_name) {
            Category::create([
                'name' => $category_name
            ]);

        }
        

        //
    }
}
