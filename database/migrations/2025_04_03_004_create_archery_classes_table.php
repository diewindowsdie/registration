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
        if (!Schema::hasTable(self::TABLE_NAME)) {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->string("code", 6)->primary();
            $table->string("title");
            $table->string("allowed_gender", 2);
            $table->tinyInteger("min_age");
            $table->tinyInteger("max_age")->nullable();
        });
        }

        DB::table(self::TABLE_NAME)->insert([
            ["code" => "M", "title" => "Мужчины", "allowed_gender" => "M", "min_age" => 11, "max_age" => null],
            ["code" => "W", "title" => "Женщины", "allowed_gender" => "F", "min_age" => 11, "max_age" => null],
            ["code" => "U21M", "title" => "Юниоры", "allowed_gender" => "M", "min_age" => 11, "max_age" => 21],
            ["code" => "U21W", "title" => "Юниорки", "allowed_gender" => "F", "min_age" => 11, "max_age" => 21],
            ["code" => "U18M", "title" => "Юноши", "allowed_gender" => "M", "min_age" => 11, "max_age" => 18],
            ["code" => "U18W", "title" => "Девушки", "allowed_gender" => "F", "min_age" => 11, "max_age" => 18],
            ["code" => "U14M", "title" => "Мальчики", "allowed_gender" => "M", "min_age" => 11, "max_age" => 14],
            ["code" => "U14W", "title" => "Девочки", "allowed_gender" => "F", "min_age" => 11, "max_age" => 14]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
