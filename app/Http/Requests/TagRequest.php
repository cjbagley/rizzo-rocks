<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        $tag = $this->route('tag');
        $tag_id = ($tag instanceof Tag) ? $tag->id : null;

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
