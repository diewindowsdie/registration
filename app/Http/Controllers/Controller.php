<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;

abstract class Controller
{
    public static function wrapUnsafeBoolean(array $array, string $key): int
    {
        if (!isset($array[$key])) {
            return 0;
        }

        return $array[$key] == true;
    }

    public static function wrapUnsafeBooleanFromRequest(FormRequest $request, string $key): int
    {
        if (!$request->has($key)) {
            return 0;
        }

        //тут нужна именно проверка, игнорирующая типы, потому что по всей видимости input(..) может вернуть объекты разных типов
        return $request->input($key) == "true" || $request->input($key) == "1";
    }
}
