<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE_NAME = "divisions";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->string("code", 3)->primary();
                $table->string("title");
            });
        }

        DB::table(self::TABLE_NAME)->insert([
            ["code" => "R", "title" => "Классический лук"],
            ["code" => "C", "title" => "Блочный лук"],
            ["code" => "B", "title" => "Баребоу (Классический лук бесприцельный)"],
            ["code" => "L", "title" => "Лонгбоу"],
            ["code" => "T", "title" => "Традиционный (составной) лук"]
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
