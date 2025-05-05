\<?php

use App\Models\CompetitionParticipant;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    private const TABLE_NAME = "competition_participants";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach(CompetitionParticipant::all() as $participant) {
            if ($participant->athlete !== null) {
                $participant->region_code = $participant->athlete->region_code;
                $participant->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
