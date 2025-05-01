<?php

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
        DB::table(self::TABLE_NAME)->where("code", "01")->update(["code" => "АДГ"]);
        DB::table(self::TABLE_NAME)->where("code", "04")->update(["code" => "РАЛТ"]);
        DB::table(self::TABLE_NAME)->where("code", "02")->update(["code" => "БШК"]);
        DB::table(self::TABLE_NAME)->where("code", "03")->update(["code" => "БУР"]);
        DB::table(self::TABLE_NAME)->where("code", "05")->update(["code" => "ДАГ"]);
        DB::table(self::TABLE_NAME)->where("code", "80")->update(["code" => "ДНР"]);
        DB::table(self::TABLE_NAME)->where("code", "06")->update(["code" => "ИНГ"]);
        DB::table(self::TABLE_NAME)->where("code", "07")->update(["code" => "КБЛК"]);
        DB::table(self::TABLE_NAME)->where("code", "08")->update(["code" => "КЛМК"]);
        DB::table(self::TABLE_NAME)->where("code", "09")->update(["code" => "КЧЕР"]);
        DB::table(self::TABLE_NAME)->where("code", "10")->update(["code" => "КАРЕ"]);
        DB::table(self::TABLE_NAME)->where("code", "11")->update(["code" => "КОМИ"]);
        DB::table(self::TABLE_NAME)->where("code", "82")->update(["code" => "КРЫМ"]);
        DB::table(self::TABLE_NAME)->where("code", "81")->update(["code" => "ЛНР"]);
        DB::table(self::TABLE_NAME)->where("code", "12")->update(["code" => "РМЭЛ"]);
        DB::table(self::TABLE_NAME)->where("code", "13")->update(["code" => "МРДВ"]);
        DB::table(self::TABLE_NAME)->where("code", "14")->update(["code" => "ЯКУ"]);
        DB::table(self::TABLE_NAME)->where("code", "15")->update(["code" => "СЕВО"]);
        DB::table(self::TABLE_NAME)->where("code", "16")->update(["code" => "ТАТ"]);
        DB::table(self::TABLE_NAME)->where("code", "17")->update(["code" => "ТЫВА"]);
        DB::table(self::TABLE_NAME)->where("code", "18")->update(["code" => "УДМ"]);
        DB::table(self::TABLE_NAME)->where("code", "19")->update(["code" => "ХАК"]);
        DB::table(self::TABLE_NAME)->where("code", "20")->update(["code" => "ЧЕЧ"]);
        DB::table(self::TABLE_NAME)->where("code", "21")->update(["code" => "ЧУВ"]);

        DB::table(self::TABLE_NAME)->where("code", "22")->update(["code" => "АЛТК"]);
        DB::table(self::TABLE_NAME)->where("code", "75")->update(["code" => "ЗАБ"]);
        DB::table(self::TABLE_NAME)->where("code", "41")->update(["code" => "КАМЧ"]);
        DB::table(self::TABLE_NAME)->where("code", "23")->update(["code" => "КРДР"]);
        DB::table(self::TABLE_NAME)->where("code", "24")->update(["code" => "КРЯР"]);
        DB::table(self::TABLE_NAME)->where("code", "59")->update(["code" => "ПЕРМ"]);
        DB::table(self::TABLE_NAME)->where("code", "25")->update(["code" => "ПРИМ"]);
        DB::table(self::TABLE_NAME)->where("code", "26")->update(["code" => "СТАВ"]);
        DB::table(self::TABLE_NAME)->where("code", "27")->update(["code" => "ХАБ"]);

        DB::table(self::TABLE_NAME)->where("code", "28")->update(["code" => "АМУР"]);
        DB::table(self::TABLE_NAME)->where("code", "29")->update(["code" => "АРХА"]);
        DB::table(self::TABLE_NAME)->where("code", "30")->update(["code" => "АСТР"]);
        DB::table(self::TABLE_NAME)->where("code", "31")->update(["code" => "БЕЛГ"]);
        DB::table(self::TABLE_NAME)->where("code", "32")->update(["code" => "БРЯ"]);
        DB::table(self::TABLE_NAME)->where("code", "33")->update(["code" => "ВЛДМ"]);
        DB::table(self::TABLE_NAME)->where("code", "34")->update(["code" => "ВОЛГ"]);
        DB::table(self::TABLE_NAME)->where("code", "35")->update(["code" => "ВЛГД"]);
        DB::table(self::TABLE_NAME)->where("code", "36")->update(["code" => "ВОРО"]);
        DB::table(self::TABLE_NAME)->where("code", "85")->update(["code" => "ЗПРО"]);
        DB::table(self::TABLE_NAME)->where("code", "37")->update(["code" => "ИВА"]);
        DB::table(self::TABLE_NAME)->where("code", "38")->update(["code" => "ИРК"]);
        DB::table(self::TABLE_NAME)->where("code", "39")->update(["code" => "КАЛИ"]);
        DB::table(self::TABLE_NAME)->where("code", "40")->update(["code" => "КЛУЖ"]);
        DB::table(self::TABLE_NAME)->where("code", "42")->update(["code" => "КЕМ"]);
        DB::table(self::TABLE_NAME)->where("code", "43")->update(["code" => "КИР"]);
        DB::table(self::TABLE_NAME)->where("code", "44")->update(["code" => "КСТР"]);
        DB::table(self::TABLE_NAME)->where("code", "45")->update(["code" => "КУРГ"]);
        DB::table(self::TABLE_NAME)->where("code", "46")->update(["code" => "КРСК"]);
        DB::table(self::TABLE_NAME)->where("code", "47")->update(["code" => "ЛЕН"]);
        DB::table(self::TABLE_NAME)->where("code", "48")->update(["code" => "ЛИП"]);
        DB::table(self::TABLE_NAME)->where("code", "49")->update(["code" => "МАГ"]);
        DB::table(self::TABLE_NAME)->where("code", "50")->update(["code" => "МСКО"]);
        DB::table(self::TABLE_NAME)->where("code", "51")->update(["code" => "МУРМ"]);
        DB::table(self::TABLE_NAME)->where("code", "52")->update(["code" => "НИЖН"]);
        DB::table(self::TABLE_NAME)->where("code", "53")->update(["code" => "НОВГ"]);
        DB::table(self::TABLE_NAME)->where("code", "54")->update(["code" => "НСБО"]);
        DB::table(self::TABLE_NAME)->where("code", "55")->update(["code" => "ОМСК"]);
        DB::table(self::TABLE_NAME)->where("code", "56")->update(["code" => "ОРЕН"]);
        DB::table(self::TABLE_NAME)->where("code", "57")->update(["code" => "ОРЛ"]);
        DB::table(self::TABLE_NAME)->where("code", "58")->update(["code" => "ПЕНЗ"]);
        DB::table(self::TABLE_NAME)->where("code", "60")->update(["code" => "ПСК"]);
        DB::table(self::TABLE_NAME)->where("code", "61")->update(["code" => "РОСТ"]);
        DB::table(self::TABLE_NAME)->where("code", "62")->update(["code" => "РЯЗ"]);
        DB::table(self::TABLE_NAME)->where("code", "63")->update(["code" => "САМ"]);
        DB::table(self::TABLE_NAME)->where("code", "64")->update(["code" => "САР"]);
        DB::table(self::TABLE_NAME)->where("code", "65")->update(["code" => "САХ"]);
        DB::table(self::TABLE_NAME)->where("code", "66")->update(["code" => "СВРД"]);
        DB::table(self::TABLE_NAME)->where("code", "67")->update(["code" => "СМОЛ"]);
        DB::table(self::TABLE_NAME)->where("code", "68")->update(["code" => "ТАМБ"]);
        DB::table(self::TABLE_NAME)->where("code", "69")->update(["code" => "ТВЕР"]);
        DB::table(self::TABLE_NAME)->where("code", "70")->update(["code" => "ТОМ"]);
        DB::table(self::TABLE_NAME)->where("code", "71")->update(["code" => "ТУЛ"]);
        DB::table(self::TABLE_NAME)->where("code", "72")->update(["code" => "ТЮМ"]);
        DB::table(self::TABLE_NAME)->where("code", "73")->update(["code" => "УЛЬЯ"]);
        DB::table(self::TABLE_NAME)->where("code", "84")->update(["code" => "ХРСН"]);
        DB::table(self::TABLE_NAME)->where("code", "74")->update(["code" => "ЧЛБ"]);
        DB::table(self::TABLE_NAME)->where("code", "76")->update(["code" => "ЯРО"]);

        DB::table(self::TABLE_NAME)->where("code", "77")->update(["code" => "МСК"]);
        DB::table(self::TABLE_NAME)->where("code", "78")->update(["code" => "СПБ"]);
        DB::table(self::TABLE_NAME)->where("code", "92")->update(["code" => "СЕВ"]);

        DB::table(self::TABLE_NAME)->where("code", "79")->update(["code" => "ЕВАО"]);

        DB::table(self::TABLE_NAME)->where("code", "83")->update(["code" => "НЕАО"]);
        DB::table(self::TABLE_NAME)->where("code", "86")->update(["code" => "ХМАО"]);
        DB::table(self::TABLE_NAME)->where("code", "87")->update(["code" => "ЧУАО"]);
        DB::table(self::TABLE_NAME)->where("code", "89")->update(["code" => "ЯНАО"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
