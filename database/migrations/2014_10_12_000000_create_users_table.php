<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
           
            $table->id();
            $table->string('name'); //名前
            $table->string('email')->unique(); //email
            $table->string('password'); //パスワード
            $table->boolean('paid_flg')->default(0); //有料フラグ  0：無料 1：有料
            $table->string('postal_code')->default('');  //郵便番号
            $table->string('address');  //住所
            $table->string('phone')->default('');  //電話番号
            $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


/*
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

*/