<?php

namespace App\Helpers;

class Helpers
{
    const TAG_PARAM_SEPARATOR = '-';

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

    public function prepareParamTags(string $tag_param): array
    {
        $tag_param = trim(preg_replace('/[^a-zA-Z-]/', '', $tag_param));
        if ($tag_param === '') {
            return [];
        }

        $parts = explode(self::TAG_PARAM_SEPARATOR, $tag_param);
        if (count($parts) == 0) {
            return [];
        }

        $tags = [];
        foreach ($parts as $part) {
            $part = strtoupper(substr($part, 0, 3));
            if (trim($part) !== '') {
                $tags[] = trim($part);
            }
        }

        return $tags;
    }
}
