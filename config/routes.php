<?php

/**
* @author Koffi Sani <mailto:koffisani@gmail.com>
* @link https://koffisani.github.io
*
**/

use Chatter\Models\Message;


//Defines app routes
$app->get("/", function($request, $response, $args){
  return $response->write("Salut à tous");
});

$app->get("/messages", function($request, $response, $args){
  $_message = new Message();
  $messages = $_message->all();

  $payload = [];
  foreach ($messages as $_msg) {
    $payload[$_msg->id] = [
      'body' => $_msg->body,
      'user_id' => $_msg->user_id,
      'created_at' => $_msg->created_at
    ];
  }
  return $response->withStatus(200)->withJSon($payload);
  //return $response->write("This is our list of messages");
});
