<?php

namespace Chatter\Middleware;

use Aws\S3\S3Client;

class FileMove
{
  public function __invoke($request, $response, $next)
  {
      $s3 = new S3CLient([
          'version' => 'latest',
          'region' => 'us-west-2'
      ]);
      $files = $request->getUploadedFiles();
      $newfile = $files['file'];
      $uploadFilename = $newfile->getClientFilename();
      $pngfile = "assets/images/" . substr($uploadFilename, 0, -4) . ".png";

      try{
          $s3->putObject([
              'Bucket' => 'my-bucket',
              'Key' =>'my-object',
              'Body' => fopen($pngfile, 'w'),
              'ACL' => 'public-read'
          ]);
      }catch(Exception $exc){
          return $response->withStatus(400);
      }
    $response = $next($request, $response);

    return $response;
  }
}
