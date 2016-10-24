<?php

namespace Chatter\Middleware;

class Authentication
{
  public function __invoke($request, $response, $next)
  {
    $auth = $request->getHeader('Authorization');
    $_apikey = $auth[0];

    $apikey = substr($_apikey, strpos($_apikey, ' ') + 1);

    $user = new User();

    if(!user->authenticate($apikey)){
      $response->withStatus(401);
    }
    $response = $next($request, $response);

    return $response;
  }
}
