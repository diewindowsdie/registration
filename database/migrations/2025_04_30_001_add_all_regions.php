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
        DB::table(self::TABLE_NAME)->insert([
            ["code" => "01", "full_name" => "Республика Адыгея"],
            ["code" => "04", "full_name" => "Республика Алтай"],
            ["code" => "02", "full_name" => "Республика Башкортостан"],
            ["code" => "03", "full_name" => "Республика Бурятия"],
            ["code" => "05", "full_name" => "Республика Дагестан"],
            ["code" => "80", "full_name" => "Донецкая Народная Республика"],
            ["code" => "06", "full_name" => "Республика Ингушетия"],
            ["code" => "07", "full_name" => "Кабардино-Балкарская Республика"],
            ["code" => "08", "full_name" => "Республика Калмыкия"],
            ["code" => "09", "full_name" => "Карачаево-Черкесская Республика"],
            ["code" => "10", "full_name" => "Республика Карелия"],
            ["code" => "11", "full_name" => "Республика Коми"],
            ["code" => "82", "full_name" => "Республика Крым"],
            ["code" => "81", "full_name" => "Луганская Народная Республика"],
            ["code" => "12", "full_name" => "Республика Марий Эл"],
            ["code" => "13", "full_name" => "Республика Мордовия"],
            ["code" => "14", "full_name" => "Республика Саха (Якутия)"],
            ["code" => "15", "full_name" => "Республика Северная Осетия — Алания"],
            ["code" => "16", "full_name" => "Республика Татарстан"],
            ["code" => "17", "full_name" => "Республика Тыва"],
            ["code" => "18", "full_name" => "Удмуртская Республика"],
            ["code" => "19", "full_name" => "Республика Хакасия"],
            ["code" => "20", "full_name" => "Чеченская Республика"],
            ["code" => "21", "full_name" => "Чувашская Республика"],

            ["code" => "22", "full_name" => "Алтайский край"],
            ["code" => "75", "full_name" => "Забайкальский край"],
            ["code" => "41", "full_name" => "Камчатский край"],
            ["code" => "23", "full_name" => "Краснодарский край"],
            ["code" => "24", "full_name" => "Красноярский край"],
            ["code" => "59", "full_name" => "Пермский край"],
            ["code" => "25", "full_name" => "Приморский край"],
            ["code" => "26", "full_name" => "Ставропольский край"],
            ["code" => "27", "full_name" => "Хабаровский край"],

            ["code" => "28", "full_name" => "Амурская область"],
            ["code" => "29", "full_name" => "Архангельская область"],
            ["code" => "30", "full_name" => "Астраханская область"],
            ["code" => "31", "full_name" => "Белгородская область"],
            ["code" => "32", "full_name" => "Брянская область"],
            ["code" => "33", "full_name" => "Владимирская область"],
            ["code" => "34", "full_name" => "Волгоградская область"],
            ["code" => "35", "full_name" => "Вологодская область"],
            ["code" => "36", "full_name" => "Воронежская область"],
            ["code" => "85", "full_name" => "Запорожская область"],
            ["code" => "37", "full_name" => "Ивановская область"],
            ["code" => "38", "full_name" => "Иркутская область"],
            ["code" => "39", "full_name" => "Калининградская область"],
            ["code" => "40", "full_name" => "Калужская область"],
            ["code" => "42", "full_name" => "Кемеровская область — Кузбасс"],
            ["code" => "43", "full_name" => "Кировская область"],
            ["code" => "44", "full_name" => "Костромская область"],
            ["code" => "45", "full_name" => "Курганская область"],
            ["code" => "46", "full_name" => "Курская область"],
            //["code" => "47", "full_name" => "Ленинградская область"],
            ["code" => "48", "full_name" => "Липецкая область"],
            ["code" => "49", "full_name" => "Магаданская область"],
            ["code" => "50", "full_name" => "Московская область"],
            ["code" => "51", "full_name" => "Мурманская область"],
            ["code" => "52", "full_name" => "Нижегородская область"],
            ["code" => "53", "full_name" => "Новгородская область"],
            ["code" => "54", "full_name" => "Новосибирская область"],
            ["code" => "55", "full_name" => "Омская область"],
            ["code" => "56", "full_name" => "Оренбургская область"],
            ["code" => "57", "full_name" => "Орловская область"],
            ["code" => "58", "full_name" => "Пензенская область"],
            //["code" => "60", "full_name" => "Псковская область"],
            ["code" => "61", "full_name" => "Ростовская область"],
            ["code" => "62", "full_name" => "Рязанская область"],
            ["code" => "63", "full_name" => "Самарская область"],
            ["code" => "64", "full_name" => "Саратовская область"],
            ["code" => "65", "full_name" => "Сахалинская область"],
            ["code" => "66", "full_name" => "Свердловская область"],
            ["code" => "67", "full_name" => "Смоленская область"],
            ["code" => "68", "full_name" => "Тамбовская область"],
            ["code" => "69", "full_name" => "Тверская область"],
            ["code" => "70", "full_name" => "Томская область"],
            ["code" => "71", "full_name" => "Тульская область"],
            ["code" => "72", "full_name" => "Тюменская область"],
            ["code" => "73", "full_name" => "Ульяновская область"],
            ["code" => "84", "full_name" => "Херсонская область"],
            ["code" => "74", "full_name" => "Челябинская область"],
            ["code" => "76", "full_name" => "Ярославская область"],

            ["code" => "77", "full_name" => "Москва"],
            //["code" => "78", "full_name" => "Санкт-Петербург"],
            ["code" => "92", "full_name" => "Севастополь"],

            ["code" => "79", "full_name" => "Еврейская АО"],

            ["code" => "83", "full_name" => "Ненецкий АО"],
            ["code" => "86", "full_name" => "Ханты-Мансийский АО — Югра"],
            ["code" => "87", "full_name" => "Чукотский АО"],
            ["code" => "89", "full_name" => "Ямало-Ненецкий АО"],

            ["code" => "ARM", "full_name" => "Republic of Armenia"],
            ["code" => "BLR", "full_name" => "Republic of Belarus"],
            ["code" => "CHN", "full_name" => "People's Republic of China"],
            ["code" => "COL", "full_name" => "Republic of Colombia"],
            ["code" => "KAZ", "full_name" => "Republic of Kazakhstan"],
            ["code" => "KGZ", "full_name" => "Kyrgyz Republic"],
            ["code" => "KOR", "full_name" => "Republic of Korea"],
            ["code" => "MEX", "full_name" => "United Mexican States"],
            ["code" => "PAK", "full_name" => "Islamic Republic of Pakistan"],
            //["code" => "RUS", "full_name" => "Russian Federation"],
            ["code" => "SRI", "full_name" => "Democratic Socialist Republic of Sri Lanka"],
            //["code" => "TJK", "full_name" => "Republic of Tajikistan"],
            ["code" => "TKM", "full_name" => "Turkmenistan"],
            ["code" => "TUR", "full_name" => "Republic of Türkiye"],
            ["code" => "UZB", "full_name" => "Republic of Uzbekistan"],
        ]);

        DB::table(self::TABLE_NAME)->where("code", "LO")->update(["code" => "47"]);
        DB::table(self::TABLE_NAME)->where("code", "SPB")->update(["code" => "78"]);
        DB::table(self::TABLE_NAME)->where("code", "PSO")->update(["code" => "60"]);

        DB::table(self::TABLE_NAME)->where("code", "RUS")->update(["full_name" => "Russian Federation"]);
        DB::table(self::TABLE_NAME)->where("code", "TJK")->update(["full_name" => "Republic of Tajikistan"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
