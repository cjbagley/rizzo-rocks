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
            'igdb_cover_id' => ['nullable', 'string', 'max:255'],
            'igdb_url' => ['nullable', 'string', 'url', 'max:255'],
            'comments' => ['nullable', 'string'],
        ];
    }
}
