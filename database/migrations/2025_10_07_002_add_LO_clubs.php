<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    private const TABLE_NAME = "sport_organisations";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table(self::TABLE_NAME)->insert([
            ["code" => "IZHORETS", "short_title" => "СОК \"Ижорец\"", "full_title" => "СПб ГБУ СОК \"Ижорец\""]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
