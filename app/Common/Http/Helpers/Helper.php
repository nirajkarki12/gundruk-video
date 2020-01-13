<?php 

namespace App\Common\Http\Helpers;
use File;
class Helper
{

  public static function fileName() {
    $name = time();
    $name .= rand();
    $name = sha1($name);

    return $name;
  }

  public static function uploadPicture($image, $folder)
  {
      $fileName = Helper::fileName();

      $ext = $image->getClientOriginalExtension();

      $localUrl = $fileName . "." . $ext;

      $path = storage_path($folder .'/');

      $inputFile = env('APP_URL') .$path .$localUrl;

      // Convert bytes into MB
      $bytes = $image->getClientSize()/1024;

      if ($bytes > 8) {
      // if ($bytes > Setting::get('image_compress_size')) {

          // Compress the video and save in original folder
          $FFmpeg = new \FFmpeg;

          $FFmpeg
              ->input($image->getPathname())
              ->output($inputFile)
              ->ready();
              dd($image);
          dd($FFmpeg->command);
      } else {
        $image->move($path, $localUrl);
      }

      return $localUrl;
  }

  public static function uploadImage($image,$folder)
  {
      $fileName = Helper::fileName();

      $ext = $image->getClientOriginalExtension();

      $localUrl = $fileName . "." . $ext;

      $path = storage_path('app/public/'.$folder);

      $image->move($path, $localUrl);

      return $localUrl;
  }

  public static function deleteImage($image,$folder)
  {
    $path=storage_path('app/public/'.$folder.'/'.$image);
    if(File::exists($path))
    {
      File::delete($path);
    }
  }
}