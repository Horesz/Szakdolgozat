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
        // Hűségpontok hozzáadása a felhasználókhoz
        Schema::table('users', function (Blueprint $table) {
            $table->integer('loyalty_points')->default(0)->after('role');
        });

        // Hűségpont és vendég mezők hozzáadása a rendelésekhez
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_guest')->default(false)->after('coupon_code');
            $table->string('guest_token')->nullable()->after('is_guest');
            $table->integer('loyalty_points_used')->default(0)->after('discount');
            $table->integer('loyalty_points_earned')->default(0)->after('loyalty_points_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('loyalty_points');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['is_guest', 'guest_token', 'loyalty_points_used', 'loyalty_points_earned']);
        });
    }
};