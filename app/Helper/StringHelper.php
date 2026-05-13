<?php

namespace App\Helper;

use Illuminate\Support\Str;

class StringHelper
{
    public static function getFullName($firstName, $lastName)
    {
        $fullname = trim($firstName.' '.$lastName);

        return Str::lower($fullname);
    }
}
