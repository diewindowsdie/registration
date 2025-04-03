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
        Schema::create('sport_schools', function (Blueprint $table) {
            $table->string("code", 10)->primary();
            $table->string("short_title");
            $table->string("full_title");
        });

        DB::table("sport_schools")->insert([
            ["code" => "KSHVSM", "short_title" => "КШВСМ", "full_title" => "СПб ГБУ ДО СШОР \"КШВСМ\""],
            ["code" => "SSHOR_KALI", "short_title" => "СШОР №1 Калининского р-на", "full_title" => "ГБУ ДО СШОР №1 Калининского района"],
            ["code" => "SSHOR_PUSH", "short_title" => "СШОР Пушкинского р-на", "full_title" => "ГБУ ДО СШОР Пушкинского района"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_schools');
    }
};
