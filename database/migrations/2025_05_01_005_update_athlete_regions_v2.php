<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "athletes";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table(self::TABLE_NAME)->where("region_code", "47")->update(["region_code" => "ЛЕН"]);
        DB::table(self::TABLE_NAME)->where("region_code", "78")->update(["region_code" => "СПБ"]);
        DB::table(self::TABLE_NAME)->where("region_code", "60")->update(["region_code" => "ПСК"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
