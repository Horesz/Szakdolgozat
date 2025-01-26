<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Alapvető termék információk
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            
            // Kategória kapcsolat
            $table->foreignId('category_id')->constrained('categories');
            
            // Termék típusok
            $table->enum('type', [
                'Konzol', 
                'Számítógép', 
                'Laptop', 
                'Perifériák', 
                'Játékszoftver', 
                'Kiegészítők'
            ]);

            // Márka információ
            $table->string('brand');
            
            // Részletes termékjellemzők JSON mezőben
            $table->json('specifications')->nullable();
            
            // Kiterjedt termékleírás
            $table->text('short_description');
            $table->longText('full_description');
            
            // Árréssel és kedvezménnyel kapcsolatos mezők
            $table->decimal('original_price', 10, 2)->nullable();
            $table->integer('discount_percentage')->default(0);
            
            // Termék állapota
            $table->enum('status', [
                'Aktív', 
                'Inaktív', 
                'Hamarosan érkezik', 
                'Elfogyott'
            ])->default('Aktív');
            
            // Garanciális információk
            $table->integer('warranty_months')->nullable();
            
            // Metaadatok
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new_arrival')->default(false);
            
            // Képek tárolása JSON-ban
            $table->json('images')->nullable();
            
            // Egyéb technikai részletek
            $table->text('technical_details')->nullable();
            
            // Szűrési és keresési mezők
            $table->json('tags')->nullable();
            
            // Értékelésekhez és visszajelzésekhez
            $table->float('average_rating')->default(0);
            $table->integer('total_reviews')->default(0);
            
            // Súly és szállítási információk
            $table->decimal('weight', 8, 2)->nullable(); // kg-ban
            $table->json('shipping_details')->nullable();
            
            // Timestamp-ek
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};