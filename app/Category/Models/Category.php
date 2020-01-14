<?php

namespace App\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Video\Models\Video;
class Category extends Model
{
	use Sluggable;

	protected $fillable = ['name', 'image', 'image_full_path', 'status', 'category_id', 'slug'];

	public function setImageAttribute($image) {
		$this->attributes['image'] = $image;
		$this->attributes['image_full_path'] = env('APP_URL') .'/storage/category/' .$image;
	}

	public function categories()
	{
		return $this->hasMany(Category::class, 'category_id', 'id');
	}

	public function childrenCategories()
	{
		return $this->hasMany(Category::class)->with('categories');
	}

	public function parent()
	{
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
				]
		];
	}

	public function videos()
	{
		return $this->hasMany(Video::class);
	}
}
