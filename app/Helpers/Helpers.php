<?php

namespace App\Helpers;

class Helpers
{
    public function firstNonEmpty(array $arr = [], mixed $default = null): mixed
    {
        if ($arr === []) {
            return $default;
        }

        foreach ($arr as $value) {
            if (! empty($value)) {
                return $value;
            }
        }

        return $default;
    }
}
