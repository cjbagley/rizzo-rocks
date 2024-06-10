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

    public function sanitiseString(string $string): string
    {
        return trim(preg_replace('/[^a-zA-Z0-9 ]/', '', $string));
    }
}
