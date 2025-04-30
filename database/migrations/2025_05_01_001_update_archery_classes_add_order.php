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
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->tinyInteger("order")->default(0);
            });

            DB::table(self::TABLE_NAME)
                ->where("code", "=", "M")
                ->update(["order" => 1]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "W")
                ->update(["order" => 2]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U21M")
                ->update(["order" => 3]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U21W")
                ->update(["order" => 4]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U18M")
                ->update(["order" => 5]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U18W")
                ->update(["order" => 6]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U14M")
                ->update(["order" => 7]);
            DB::table(self::TABLE_NAME)
                ->where("code", "=", "U14W")
                ->update(["order" => 8]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
