<?php

namespace App\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\user\Models\User;
use App\User\Models\Admin;
use App\Tag\Models\Tag;
use App\Category\Models\Category;
use App\Common\Http\Helpers\Settings;
use Storage;
class Video extends Model
{
    use SoftDeletes,Sluggable;
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>['title','id']
            ]
        ];
    }

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug']=md5($slug.time());
    }

    public function getUrlAttribute($video)
    {
        // return Storage::disk(Settings::get('uploaddisk'))->get($video);
        return Storage::disk(Settings::get('uploaddisk'))->path($video);
        return \public_path('storage/videos/'.$video);
    }

    public function getImageAttribute($image)
    {
        return \URL::to('storage/videos/'.$image);

        return \Storage::path('images/'.$image);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');
    }

    public function setPublishAtAttribute($publish_at)
    {
        $publish_date=new \DateTime($publish_at);
        $this->attributes['publish_at']=$publish_date->format('Y-m-d H:i:s');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
