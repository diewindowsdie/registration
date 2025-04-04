<?php

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
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger("competition_id");
                $table->string("division", 3);
                $table->string("class", 6);
                $table->string("allowed_genders");
                $table->dateTime("min_birth_date");
                $table->dateTime("max_birth_date");

                $table->unique(["competition_id", "division", "class"]);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
