<?php 

namespace App\Common\Http\Helpers;

use File;

class Helper
{
  public static function uploadPicture($image, $folder)
  {
      $fileName = Helper::fileName();

      $ext = $image->getClientOriginalExtension();
      $localUrl = $fileName . "." . $ext;
      $path = storage_path('app/public/' .$folder);

      // $outputFile = $path .$localUrl;

      $image->move($path, $localUrl);

      return $localUrl;
  }

  public static function deleteImage($image, $folder) {
    $path = storage_path('app/public/' .$folder);

    File::delete( $path .'/' .$image);
    return true;
  }

  public static function fileName() {
    $name = time();
    $name .= rand();
    $name = sha1($name);

    return $name;
  }
  
}