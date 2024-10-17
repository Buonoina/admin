<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // 外部キーの設定
            $table->text('comment');
            $table->string('img_path');
=======
            $table->string('user_name')->default('');
            $table->string('img_path');
            $table->string('name');
            $table->integer('price');
            $table->integer('stock');
            $table->integer('company_id');
            $table->text('comment');
>>>>>>> 6d2a0fe0526d9a21b0624f06546fa7ea01537733
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
