<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ENUM helyett STRING használata - rugalmasabb megoldás
        Schema::table('products', function (Blueprint $table) {
            // A type oszlopot ideiglenesen átnevezzük
            $table->renameColumn('type', 'type_old');
        });

        Schema::table('products', function (Blueprint $table) {
            // Új type oszlop hozzáadása string típusként
            $table->string('type', 50)->after('type_old');
        });

        // Az adatok átmásolása a régi oszlopból az újba
        DB::statement('UPDATE products SET type = type_old');

        // A régi oszlop törlése
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type_old');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Ez a változtatás nem visszafordítható, mert lehet, hogy olyan adatok kerültek be,
        // amelyek nem illeszkednek az eredeti ENUM értékekhez
        Schema::table('products', function (Blueprint $table) {
            // A string type oszlopot megtartjuk, nem állítjuk vissza ENUM-ra
        });
    }
};