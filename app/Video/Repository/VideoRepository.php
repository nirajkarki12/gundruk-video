<?php
namespace App\Video\Repository;

use App\Common\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use App\Common\Http\Helpers\Helper;
use App\Video\Models\Video;
class VideoRepository implements RepositoryInterface
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

    public function create(Request $request)
    {

    }

    public function update(Request $request, int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function show(int $id)
    {

    }

}