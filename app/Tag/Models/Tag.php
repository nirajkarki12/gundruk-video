<?php

namespace App\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use App\Video\Models\Video;
class Tag extends Model
{
    protected $guarded = [];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
}
