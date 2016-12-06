<?php

namespace Chatter\Middleware;

class FileRemoveExif
{
  public function __invoke($request, $response, $next)
  {
      $files = $request->getUploadedFiles();
      $newfile = $files['file'];
      $newfile_type = $newfile->getClientMediaType();
      $uploadFilename = $newfile->getClientFilename();
      $newfile->moveTo("assets/images/raw/$uploadFilename");
      $pngfile = "asset/images/" . substr($uploadFilename, 0, -4) . ".png";

      if('image/jpeg' == $newfile_type) {
          $_img = imagecreatefromjpeg("assets/images/raw/" . $uploadFilename);
          imagepng($_img, $pngfile);
      }
      $request->withAttribute('png_filename', $pngfile);
    $response = $next($request, $response);

    return $response;
  }
}
