<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "competition_participants";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->unsignedBigInteger("athlete_id");
                $table->unsignedBigInteger("competition_id");
                $table->string("division", 3);
                $table->string("class", 6);
                $table->tinyInteger("team_participation")->nullable();
                $table->tinyInteger("mixed_team_participation")->nullable();
                $table->string("sport_school", 15)->nullable();
                $table->string("sport_organisation", 15)->nullable();
                $table->string("contact_information");
                $table->string("coach_name")->nullable();

                $table->unique(["athlete_id", "competition_id", "division"], self::TABLE_NAME . "_unique");
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
