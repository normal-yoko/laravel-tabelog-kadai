<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void    
    {
        //1行だけだけど、シーダーで追加
        Administrator::create([
          'email' => 'gujiguji399@gmail.com',
          'password' => 'password'
        ]);

/*
        $table->string('email')->unique;  //メールアドレス
        $table->string('password');  //パスワード
*/

    }
}
