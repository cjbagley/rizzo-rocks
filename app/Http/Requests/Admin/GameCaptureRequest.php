<?php

namespace App\Http\Requests\Admin;

use App\Enums\GameCaptureType;
use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameCaptureRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'game_id' => ['required', 'exists:' . Game::class . ',id'],
            'type' => ['required', Rule::enum(GameCaptureType::class)],
            'href' => ['required', 'url'],
            'comments' => ['nullable', 'string', 'max:255'],
        ];
    }
}
