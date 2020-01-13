<?php

namespace App\User\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
  use Notifiable;
  protected $table = 'admins';
  protected $connection = 'mysql2';
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password', 'picture',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  // public function sluggable()
  // {
  //     return [
  //         'slug' => [
  //             'source' => 'name'
  //         ]
  //     ];
  // }

  public function setPictureAttribute($picture)
  {
      $this->attributes['picture']=\URL::to('/').'/storage/admins/'.$picture;
  }
}