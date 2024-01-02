<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LookupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['required', 'string', 'max:255'],
        ];
    }
}
