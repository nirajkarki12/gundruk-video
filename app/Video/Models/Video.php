<?php

namespace App\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\user\Models\User;
use App\User\Models\Admin;
use App\Tag\Models\Tag;
use App\Category\Models\Category;
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

    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');
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
