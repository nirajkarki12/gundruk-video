<?php
namespace App\Video\Repository;

use App\Common\Repository\RepositoryInterface;
use App\Common\Http\Helpers\Helper;
use App\Video\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoRepository
{
    protected $video,$disk;
    public function __construct(Video $video)
    {
        $this->video=$video;
        $this->disk=Storage::disk('video');

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
        $input['publish_at']=$data['publish_at'];
        if($this->video::create($input))
        {
            return true;
        }
        return false;
    }

    public function update(Request $request, int $id)
    {

    }

    public function delete($slug)
    {
        $video=$this->video::where('slug',$slug)->first();
        $video->published=0;
        $video->update();
        if($video->delete())
        {
            return true;
        }
        return false;
    }

    public function show($slug)
    {
        return $this->video::where('slug',$slug)->first();
    }

    public function deleted()
    {
        return $this->video::onlyTrashed()->orderBy('deleted_at','desc')->paginate(3);
    }

    public function unDelete($slug)
    {
        $video=$this->video::where('slug',$slug)->onlyTrashed()->first();
        $video->deleted_at=null;
        if($video->update())
        {
            return true;
        }
        return false;
    }

    public function parmanentDestroy($slug)
    {
        $video=$this->video::where('slug',$slug)->onlyTrashed()->first();
        if($video->forceDelete())
        {
            if($this->disk->exists($video->getOriginal('url')))
            {
                $this->disk->delete($video->getOriginal('url'));
            }

            if($this->disk->exists($video->getOriginal('image')))
            {
                $this->disk->delete($video->getOriginal('image'));
            }
            return true;
        }
        return false;
    }

}