<?php

namespace App\Video\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\user\Models\User;
use App\User\Models\Admin;
use App\Tag\Models\Tag;
class Video extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function sluggable()
    {
        return [
            'slug'=>[
                'source'=>['id','category_id','title']
            ]
        ];
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
}
