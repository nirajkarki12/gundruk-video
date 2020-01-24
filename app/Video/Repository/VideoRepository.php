<?php
namespace App\Video\Repository;

use App\Common\Repository\RepositoryInterface;
use App\Common\Http\Helpers\Helper;
use App\Video\Models\Video;
use Illuminate\Support\Facades\Storage;
use App\Common\Http\Helpers\Settings;
use App\Common\Repository\MainRepository;
use App\Tag\Repository\TagRepository;
class VideoRepository extends MainRepository
{
    protected $video,$disk,$tagRepo;
    public function __construct(Video $video,TagRepository $tagRepo)
    {
        parent::__construct();
        $this->video=$video;
        $this->tagRepo=$tagRepo;
        $this->disk=Storage::disk($this->uploadDisk);
    }
    public function all()
    {
        return $this->video::where('user_id',auth()->guard('admin')->user()->id)->paginate($this->pagination);   
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
        if($video=$this->video::create($input))
        {
            $tags=explode(',',$data['tag']);
            foreach($tags as $tag)
            {
                $video->tags()->attach($this->tagRepo->store(['name'=>$tag]));
            }
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
        return $this->video::where('slug',$slug)->withTrashed()->first();
    }

    public function deleted()
    {
        return $this->video::onlyTrashed()->orderBy('deleted_at','desc')->paginate($this->pagination);
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