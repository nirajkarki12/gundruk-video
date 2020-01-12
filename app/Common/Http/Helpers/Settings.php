<?php
namespace App\Common\Http\Helpers;

use App\Setting\Models\Setting;

class Settings
{
    public static function get($key)
    {
    	$setting = Setting::where('key', $key)->first();
    	if($setting)
    	{
    		return $setting->value;
    	}else return false;
    }
}