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
        DB::table(self::TABLE_NAME)->where("region_code", "LO")->update(["region_code" => "47"]);
        DB::table(self::TABLE_NAME)->where("region_code", "SPB")->update(["region_code" => "78"]);
        DB::table(self::TABLE_NAME)->where("region_code", "PSO")->update(["region_code" => "60"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
