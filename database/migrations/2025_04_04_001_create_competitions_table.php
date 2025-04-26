<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "competitions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string("title");
                $table->date("start_date");
                $table->date("end_date");
                $table->string("created_by");
                $table->dateTime("registration_start");
                $table->dateTime("registration_finish");
                $table->tinyInteger("competition_includes_teams");
                $table->tinyInteger("competition_includes_mixed_teams");
                $table->tinyInteger("participants_list_available_to_anyone");
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
