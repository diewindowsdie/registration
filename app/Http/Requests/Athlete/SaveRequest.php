<?php

namespace App\Http\Requests\Athlete;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:ma,fe'],
            'birth_date' => ['required', 'date'],
            'region_code' => ['required', 'string', 'max:6'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'privacy' => ['required', 'accepted'],
            'advertisement' => ['nullable', 'boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
