\<?php

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
                $table->renameColumn("allowed_gender", "allowed_genders");
                $table->string("allowed_genders", 255)->change();
            });
        }
        DB::statement("update " . self::TABLE_NAME . " set allowed_genders = concat('[\"', allowed_genders, '\"]');");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->renameColumn("allowed_genders", "allowed_gender");
            });
        }
    }
};
