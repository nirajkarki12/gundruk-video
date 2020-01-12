<?php

namespace App\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    protected $fillable = ['name', 'image', 'image_full_path', 'status', 'category_id', 'slug'];

    public function categories()
    {
    	return $this->hasMany(Category::class);
    }

    public function childrenCategories()
		{
			return $this->hasMany(Category::class)->with('categories');
		}

		public function sluggable()
		{
	    return [
        'slug' => [
        	'source' => 'name'
        ]
	    ];
		}
}
