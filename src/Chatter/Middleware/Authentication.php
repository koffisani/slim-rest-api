<?php

namespace Chatter\Middleware;

use Chatter\Models\User;
class Authentication
{
  public function __invoke($request, $response, $next)
  {
    $auth = $request->getHeader('Authorization');
    //echo $apikey;
    if(!$auth){
        $t = [
            'reponse' => "Vous devez vous authentifier pour accéder à cette ressource."
        ];
        $response->withStatus(401)->withJSon($t);
        return $response;
    }
    $_apikey = $auth[0];

    $apikey = substr($_apikey, strpos($_apikey, ' ') + 1);

    $user = new User();

    if(!$user->authenticate($apikey)){
      $response->withStatus(401);

      return $response;
    }
    $response = $next($request, $response);

    return $response;
  }
}
