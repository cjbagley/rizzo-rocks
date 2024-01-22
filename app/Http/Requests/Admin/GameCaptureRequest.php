<?php

namespace App\Http\Requests\Admin;

use App\Enums\GameCaptureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameCaptureRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(GameCaptureType::class)],
            'href' => ['required', 'url'],
            'comments' => ['nullable', 'string', 'max:255'],
        ];
    }
}
