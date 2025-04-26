<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "sport_organisations";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->string("code", 15)->primary();
                $table->string("short_title");
                $table->string("full_title");
            });
        }

        DB::table(self::TABLE_NAME)->insert([
            ["code" => "CSKA", "short_title" => "ЦСКА", "full_title" => "ЦСКА"],
            ["code" => "DINAMO", "short_title" => "Динамо", "full_title" => "ОГО ВФСО \"Динамо\""],
            ["code" => "N_MAYAK", "short_title" => "Невский маяк", "full_title" => "ШСК \"Невский маяк\""],
            ["code" => "ORION", "short_title" => "Орион", "full_title" => "ССК \"Орион\""],
            ["code" => "PARADOX", "short_title" => "Парадокс лучника", "full_title" => "ЛК \"Парадокс лучника\""],
            ["code" => "SFSLLO", "short_title" => "РОО \"СФСЛЛО\"", "full_title" => "РОО \"СФСЛЛО\""],
            ["code" => "SPFSL", "short_title" => "РОФСО \"СПФСЛ\"", "full_title" => "РОФСО \"СПФСЛ\""],
            ["code" => "TSAR_SEL", "short_title" => "Царское село", "full_title" => "ЦФКСЗ \"Царское село\""],
            ["code" => "AVANGARD", "short_title" => "Авангард", "full_title" => "ССК \"Авангард\""],
            ["code" => "LUCH21", "short_title" => "Луч 21", "full_title" => "СКЦ \"Луч 21\""],
            ["code" => "KLAD", "short_title" => "КЛАД", "full_title" => "КЛАД"]
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
