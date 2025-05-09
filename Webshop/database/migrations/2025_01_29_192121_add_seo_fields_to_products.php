<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords']);
    });
}

};
