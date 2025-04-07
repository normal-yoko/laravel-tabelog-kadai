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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); //$table->integer('category_id')->unsigned(); 

            $table->string('name');  //店名
            $table->string('picture'); //画像
            $table->text('description');  //説明
            $table->integer('under_price')->unsigned(); //価格帯(下限)
            $table->integer('upper_price')->unsigned(); //価格帯(上限)
            $table->string('open_time')->default(''); //営業時間(開店)
            $table->string('closed_time')->default('');  //営業時間(閉店)
            $table->string('postal_code')->default('');  //郵便番号
            $table->string('address');  //住所
            $table->string('phone')->default('');  //電話番号
            $table->string('closed_day');  //定休日

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
