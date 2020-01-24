<?php
namespace App\Channel\Repository;

use App\Channel\Interfaces\ChannelInterface;
use App\Common\Repository\MainRepository;
use App\Channel\Models\Channel;

class ChannelRepository extends MainRepository implements ChannelInterface
{
    protected $model;
    public function __construct(Channel $model)
    {
        parent::__construct();
        $this->model=$model;
    }

    public function all()
    {
        return $this->model::orderBy('created_at','desc')->get();
    }

    public function create($data=[])
    {
        if($this->model::create($data))
        {
            return true;
        }
        return false;
    }
}