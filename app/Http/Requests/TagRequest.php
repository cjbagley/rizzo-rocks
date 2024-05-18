<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tag' => ['required'],
            'colour' => ['required'],
            'is_sensitive' => ['boolean'],
        ];
    }
}
