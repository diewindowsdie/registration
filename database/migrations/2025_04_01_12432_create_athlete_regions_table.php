<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "athlete_regions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->string("code", 6)->primary();
                $table->string("full_name");
            });
        }

        DB::table(self::TABLE_NAME)->insert([
            ["code" => "SPB", "full_name" => "Санкт-Петербург"],
            ["code" => "LO", "full_name" => "Ленинградская область"],
            ["code" => "PSO", "full_name" => "Псковская область"],
            ["code" => "RUS", "full_name" => "Российская федерация"],
            ["code" => "TJK", "full_name" => "Таджикистан"]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
