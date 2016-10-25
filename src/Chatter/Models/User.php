<?php

namespace Chatter\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
  public function authenticate($apikey)
  {
    $user = User::where('apikey', '=', $apikey)->take(1)->get();
    // Need to handle exception here
    $this->details = $user[0];

    return ($user[0]->exists) ? true : false;
    }
}
