\<?php

use App\Models\CompetitionParticipant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "competition_participants";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            CompetitionParticipant::where("sport_organisation_code", "=", "DINAMO")->update(["sport_organisation_code" => null]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
        }
    }
};
