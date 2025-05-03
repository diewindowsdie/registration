\<?php

use App\Models\SportOrganisation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "sport_organisations";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            SportOrganisation::whereCode("DINAMO")->delete();
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
