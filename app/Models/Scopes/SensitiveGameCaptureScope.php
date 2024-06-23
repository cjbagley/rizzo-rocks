<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SensitiveGameCaptureScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (! auth()->check()) {
            $builder->whereHas('tags', function (Builder $q) {
                $q->where('tags.is_sensitive', '=', false);
            });
        }
    }
}
