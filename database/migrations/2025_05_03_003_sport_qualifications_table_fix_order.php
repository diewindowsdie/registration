\<?php

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
                ->where("code", "=", "Z")
                ->update(["order" => 11]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "MM")
                ->update(["order" => 10]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "M")
                ->update(["order" => 9]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "C")
                ->update(["order" => 8]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "1")
                ->update(["order" => 7]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "2")
                ->update(["order" => 6]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "3")
                ->update(["order" => 5]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "1J")
                ->update(["order" => 4]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "2J")
                ->update(["order" => 3]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "3J")
                ->update(["order" => 2]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "NO")
                ->update(["order" => 1]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->dropColumn("order");
            });
        }
    }
};
