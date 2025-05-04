\<?php

use App\Models\AthleteRegion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "athlete_regions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::TABLE_NAME)) {
            Schema::table(self::TABLE_NAME, function (Blueprint $table) {
                $table->tinyInteger("is_country")->default(0);
            });

            AthleteRegion::whereIn("code", array("ARM", "BLR", "CHN", "COL", "KAZ", "KGZ", "KOR", "MEX", "PAK", "RUS",
                "SRI", "TJK", "TKM", "TUR", "UZB"))->update(["is_country" => 1]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
