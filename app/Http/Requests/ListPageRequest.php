<?php

namespace App\Http\Requests;

use App\Helpers\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class ListPageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['string', 'nullable', 'max:30'],
            'page' => ['nullable', 'numeric'],
            'tags' => ['nullable', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $helpers = new Helpers();

        $this->merge([
            'tags' => $helpers->prepareParamTags($this->tags ?? ''),
        ]);
    }
}
