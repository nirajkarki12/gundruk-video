<?php
namespace App\Video\Repository;

use App\Common\Repository\RepositoryInterface;
use App\Common\Http\Helpers\Helper;
use App\Video\Models\Video;
class VideoRepository
{
    protected $video;
    public function __construct(Video $video)
    {
        $this->video=$video;
    }
    public function all()
    {
        return $this->video::paginate(1);   
    }

    public function create($data=[])
    {
        $input['title']=$data['title'];
        $input['url']=$data['url'];
        $input['description']=$data['description'];
        $input['image']=$data['image'];
        $input['category_id']=$data['category_id'];
        $input['user_id']=$data['user_id'];
        if($this->video::create($input))
        {
            return true;
        }
        return false;
    }

    public function update(Request $request, int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function show($slug)
    {
        return $this->video::where('slug',$slug)->first();
    }

}