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
                $table->integer('discount')->nullable(); // Kedvezmény százalék
                $table->string('image')->nullable();
                $table->unsignedBigInteger('category_id'); // Kategória ID
                $table->integer('stock')->default(0); // Készlet
                $table->boolean('featured')->default(false); // Kiemelt termék
                $table->enum('status', ['active', 'inactive'])->default('active'); // Aktív/aktív státusz
                $table->decimal('weight', 8, 2)->nullable(); // Termék súlya
                $table->unsignedBigInteger('brand_id')->nullable(); // Márka ID
                $table->timestamp('sale_start_date')->nullable(); // Kedvezmény kezdete
                $table->timestamp('sale_end_date')->nullable(); // Kedvezmény vége
                $table->timestamps();

                // Ha van márka táblád, akkor ide jöhet a márka kapcsolás
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                
                // Ellenőrizd, hogy létezik-e a 'brands' tábla
                if (Schema::hasTable('brands')) {
                    $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
