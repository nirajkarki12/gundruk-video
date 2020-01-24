<?php
namespace App\Channel\Repository;

use App\Channel\Interfaces\ChannelInterface;
use App\Common\Repository\MainRepository;
use App\Channel\Models\Channel;
use App\Common\Http\Helpers\Helper;

class ChannelRepository extends MainRepository implements ChannelInterface
{
    protected $model,$storageFolder;
    public function __construct(Channel $model)
    {
        parent::__construct();
        $this->model=$model;
        $this->storageFolder='channel';
    }

    public function all()
    {
        return $this->model::orderBy('created_at','desc')->paginate($this->pagination);
    }

    public function create($data=[])
    {
        if($this->model::create($data))
        {
            return true;
        }
        return false;
    }

    public function update($data=[],Channel $channel)
    {
        if($channel->update($data))
        {
            return true;
        }
        return false;
    }

    public function delete(string $slug)
    {
        $this->model=$this->model::where('slug',$slug)->first();
        if($this->model->delete())
        {
            Helper::deleteImage($this->model->getOriginal('image'),$this->storageFolder);
            return true;
        }
        return false;
    }
}