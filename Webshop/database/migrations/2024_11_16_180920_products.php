<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug');
                $table->text('description');
                $table->decimal('price', 10, 2);
                $table->decimal('original_price', 10, 2)->nullable();
                $table->integer('discount')->nullable();
                $table->string('image')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->integer('stock')->default(0);
                $table->boolean('featured')->default(false);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};