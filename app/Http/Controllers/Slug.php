<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Slug extends Controller
{
    static public function str_slug($str)
    {
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }
}
