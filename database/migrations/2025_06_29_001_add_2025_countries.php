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
            ["code" => "SDN", "is_country" => "1"],
            ["code" => "SRB", "is_country" => "1"],
            ["code" => "AZE", "is_country" => "1"],
            ["code" => "PHL", "is_country" => "1"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
