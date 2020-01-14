<?php
namespace App\Setting\Repository;

use App\Common\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use App\Common\Http\Helpers\Helper;
use App\Setting\Models\Setting;
class SettingRepository implements RepositoryInterface
{
    public function all()
    {
    }

    public function create(Request $request) 
    {
        try
        {
            $input=$request->all();
            foreach($input as $key=>$value)
            {
                if($key !='site_logo' && $key!='site_icon')
                {
                    $setting=Setting::where('key',$key)->first();
        
                    if($setting)
                    {
                        $setting->value=$value;
                        $setting->update();
                    }
                    else
                    {
                        Setting::create(['key'=>$key,'value'=>$value]);
                    }    
                }
            }
    
            if($request->has('site_logo'))
            {
                $setting=Setting::where('key','site_logo')->first();
                if($setting)
                {
                    Helper::deleteImage($setting->value,'logo');
                    $setting->value=Helper::uploadImage($request->site_logo,'logo');
                    $setting->update();
                }
                else
                {
                    Setting::create(['key'=>'site_logo','value'=>Helper::uploadImage($request->site_logo,'logo')]);
                }
    
            }
            
            
            if($request->has('site_icon'))
            {
                $setting=Setting::where('key','site_icon')->first();
                if($setting)
                {
                    Helper::deleteImage($setting->value,'logo');
                    $setting->value=Helper::uploadImage($request->site_icon,'logo');
                    $setting->update();
                }
                else
                {
                    Setting::create(['key'=>'site_icon','value'=>Helper::uploadImage($request->site_icon,'logo')]);
                }
            }
    
            return back()->with('flash_success', 'Settings updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error',$th->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
    }

    public function delete(int $id) {
    }

    public function show(int $id) {
    }
}
