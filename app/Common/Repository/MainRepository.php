<?php
namespace App\Common\Repository;
use App\Common\Http\Helpers\Settings;
class MainRepository
{
    protected $pagination,$uploadDisk;

    function __construct()
    {
        $this->pagination=Settings::get('pagination');
        $this->uploadDisk=Settings::get('uploaddisk');
    }
}