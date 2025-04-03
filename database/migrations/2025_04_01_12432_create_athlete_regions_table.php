<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('athlete_regions', function (Blueprint $table) {
            $table->string("code", 6)->primary();
            $table->string("full_name");
        });

        DB::table("athlete_regions")->insert([
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
        Schema::dropIfExists('athlete_regions');
    }
};
