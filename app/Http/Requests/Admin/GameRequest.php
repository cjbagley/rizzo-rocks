<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'played_years' => ['required', 'string', 'max:255'],
            'igdb_id' => ['required', 'integer', 'min:1'],
            'comments' => ['nullable', 'string'],
        ];
    }
}
