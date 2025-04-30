<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "sport_qualifications";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "1")
                ->update(["short_title" => "1р"]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "2")
                ->update(["short_title" => "2р"]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "3")
                ->update(["short_title" => "3р"]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
