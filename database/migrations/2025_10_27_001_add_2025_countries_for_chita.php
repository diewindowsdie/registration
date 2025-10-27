<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    private const TABLE_NAME = "athlete_regions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table(self::TABLE_NAME)->insert([
            ["code" => "BHR", "is_country" => "1"],
            ["code" => "ZAF", "is_country" => "1"],
            ["code" => "VNM", "is_country" => "1"],
            ["code" => "BGD", "is_country" => "1"],
            ["code" => "IDN", "is_country" => "1"],
            ["code" => "SAU", "is_country" => "1"],
            ["code" => "IRN", "is_country" => "1"],
            ["code" => "PRK", "is_country" => "1"],
            ["code" => "IND", "is_country" => "1"],
            ["code" => "MYS", "is_country" => "1"],
            ["code" => "EGY", "is_country" => "1"],
            ["code" => "SVK", "is_country" => "1"],
            ["code" => "USA", "is_country" => "1"],
            ["code" => "SVN", "is_country" => "1"],
            ["code" => "NLD", "is_country" => "1"],
            ["code" => "BRA", "is_country" => "1"],
            ["code" => "FRO", "is_country" => "1"],
            ["code" => "MNG", "is_country" => "1"],
            ["code" => "HRV", "is_country" => "1"],
            ["code" => "LVA", "is_country" => "1"],
            ["code" => "ROU", "is_country" => "1"],
            ["code" => "CHE", "is_country" => "1"]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
