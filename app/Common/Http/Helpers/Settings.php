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
	
	public static function logo($key='site_logo')
	{
		$setting=Setting::where('key',$key)->first();

		if($setting && $setting->value)
		{
			return \URL::to('/storage/logo/'.$setting->value);
		}
	}
}