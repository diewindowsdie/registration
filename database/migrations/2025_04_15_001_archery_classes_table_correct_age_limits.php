<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "archery_classes";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            DB::table(self::TABLE_NAME)->where("code", "U14M")->update(["max_age" => 13]);
            DB::table(self::TABLE_NAME)->where("code", "U14W")->update(["max_age" => 13]);
            DB::table(self::TABLE_NAME)->where("code", "U18M")->update(["max_age" => 17]);
            DB::table(self::TABLE_NAME)->where("code", "U18W")->update(["max_age" => 17]);
            DB::table(self::TABLE_NAME)->where("code", "U21M")->update(["max_age" => 20]);
            DB::table(self::TABLE_NAME)->where("code", "U21W")->update(["max_age" => 20]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
