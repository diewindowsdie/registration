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
        Schema::create('sport_qualifications', function (Blueprint $table) {
            $table->string("code", 2)->primary();
            $table->string("short_title");
            $table->string("full_title");
        });

        DB::table("sport_qualifications")->insert([
            ["code" => "Z", "short_title" => "ЗМС", "full_title" => "Заслуженный мастер спорта"],
            ["code" => "MM", "short_title" => "МСМК", "full_title" => "Мастер спорта международного класса"],
            ["code" => "M", "short_title" => "МС", "full_title" => "Мастер спорта"],
            ["code" => "C", "short_title" => "КМС", "full_title" => "Кандидат в мастера спорта"],
            ["code" => "1", "short_title" => "1", "full_title" => "Первый разряд"],
            ["code" => "2", "short_title" => "2", "full_title" => "Второй разряд"],
            ["code" => "3", "short_title" => "3", "full_title" => "Третий разряд"],
            ["code" => "1J", "short_title" => "1ю", "full_title" => "Первый юношеский разряд"],
            ["code" => "2J", "short_title" => "2ю", "full_title" => "Второй юношеский разряд"],
            ["code" => "3J", "short_title" => "3ю", "full_title" => "Третий юношеский разряд"],
            ["code" => "NO", "short_title" => "Б/р", "full_title" => "Без разряда"]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_qualifications');
    }
};
