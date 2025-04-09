\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "competition_groups";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->renameColumn("class", "archery_class");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->renameColumn("archery_class", "class");
            });
        }
    }
};
