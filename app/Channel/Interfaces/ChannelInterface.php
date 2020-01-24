<?php
namespace App\Channel\Interfaces;

interface ChannelInterface
{
    public function all();

    public function create($data=[]);
}