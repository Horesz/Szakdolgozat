<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            
            // Vásárló adatok
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            
            // Szállítási cím
            $table->string('address_zip');
            $table->string('address_city');
            $table->string('address_street');
            $table->string('address_additional')->nullable();
            
            // Fizetési adatok
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            
            // Szállítási és fizetési módok
            $table->enum('shipping_method', ['courier', 'pickup_point', 'store'])->default('courier');
            $table->enum('payment_method', ['card', 'transfer', 'cod'])->default('card');
            
            // Státuszok
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled', 'refunded'])->default('pending');
            
            // Egyéb adatok
            $table->text('order_notes')->nullable();
            $table->string('coupon_code')->nullable();
            $table->boolean('invoice_issued')->default(false);
            
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
        Schema::dropIfExists('orders');
    }
}