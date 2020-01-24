<?php
namespace App\Tag\Repository;
use App\Tag\Models\Tag;
class TagRepository
{
    protected $tagModel;
    public function __construct(Tag $tagModel)
    {   
        $this->tagModel=$tagModel;
    }

    public function store($data=[])
    {
        return $this->tagModel::firstOrCreate($data);
    }
    
}