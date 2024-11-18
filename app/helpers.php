<?php

namespace App;

use Illuminate\Support\Str;

if (! function_exists('getId')) {
    function getId(array $data, string $pattern, string $replacePattern)
    {
        $result = Str::of($data['content'])->matchAll($pattern)->unique()->transform(function ($id) use ($replacePattern) {
            return Str::of($id)->replaceMatches($replacePattern, '')->value();
        });

        return $result;
    }
}
