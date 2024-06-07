<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        $tag_id = $this->route('tag')?->id;

        return [
            'tag' => ['required'],
            'code' => [
                'required',
                Rule::unique('tags', 'code')->ignore($tag_id),
                'max:3',
            ],
            'colour' => ['required'],
            'is_sensitive' => ['boolean'],
        ];
    }
}
