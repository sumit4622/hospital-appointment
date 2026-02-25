<?php

namespace App\Helper;

class StringHelper
{
    public static function getFullName($firstName, $lastName)
    {
        return trim($firstName . ' ' . $lastName);
    }
}


