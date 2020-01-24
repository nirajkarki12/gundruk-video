<?php

namespace App\Channel\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Channel extends Model
{
    use Sluggable;
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>['name']
            ]
        ];
    }

    public function getImageAttribute($image)
    {
        return \URL::to('storage/channel/'.$image);
    }

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug']=md5($slug.time());
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
