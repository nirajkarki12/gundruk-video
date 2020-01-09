<?php
namespace App\Common\Http\Helpers;

use App\Setting\Models\Setting;

class Settings
{
    public static function get($key)
    {
        return Setting::where('key',$key)->first()->value;
    }
}