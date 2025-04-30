<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "divisions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->tinyInteger("order")->default(0);
            });

            DB::table(self::TABLE_NAME)
                ->where("code", "=", "R")
                ->update(["order" => 1]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "C")
                ->update(["order" => 2]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "B")
                ->update(["order" => 3]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "L")
                ->update(["order" => 4]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "T")
                ->update(["order" => 5]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
