<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("surname");
            $table->string("first_name");
            $table->string("patronymic")->nullable();
            $table->string("gender", 2);
            $table->date("birth_date");

            $table->string("qualification", 6)->default("NO");
            $table->tinyInteger("using_chair")->default(0);
            $table->string("region", 6);
            $table->unique(["surname", "first_name", "patronymic", "gender", "birth_date"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
