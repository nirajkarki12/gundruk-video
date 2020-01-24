<?php 

namespace App\Common\Http\Helpers;

use File;

class Helper
{
  public static function uploadImage($image, $folder)
  {
      $fileName = Helper::fileName();
      $ext = $image->getClientOriginalExtension();
      $localUrl = $fileName . "." . $ext;
      $path = storage_path('app/public/' .$folder);
      $image->move($path, $localUrl);

      return $localUrl;
  }

  public static function deleteImage($image, $folder) {
    $path = storage_path('app/public/'.$folder.'/'.$image);
    if(File::exists($path))
    {
      if(File::delete( $path))
        return true;
    }
    return false;
  }

  public static function fileName() {
    $name = time();
    $name .= rand();
    $name = sha1($name);

    return $name;
  }

}