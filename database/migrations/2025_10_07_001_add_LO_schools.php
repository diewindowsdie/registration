<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    private const TABLE_NAME = "sport_schools";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table(self::TABLE_NAME)->insert([
            ["code" => "KORELA", "short_title" => "СШ \"Корела\"", "full_title" => "МУ ДО \"Приозёрская спортивная школа \"Корела\""]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

