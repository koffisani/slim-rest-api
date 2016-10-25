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

$app->post("/messages", function($request, $response, $args){
    $_message = $request->getParsedBodyParam('message', '');

    $message = new Message();
    $message->body = $_message;
    $message->user_id = -1;
    $message->save();

    if($message->id){
        $payload = [
            'message_id' => $message->id,
            'message_uri' => '/messages/' . $message->id
        ];
        return $response->withStatus(201)->withJSon($payload);
    } else {
            return $response->withStatus(400);
    }
});

$app->delete('/messages/{message_id}', function($request, $response, $args){
    $message = Message::find($args['message_id']);
    if($message->exists){
        $message->delete();

        if($message->exists){
            return $response->withStatus(400);
        }
        else {
            return $response->withStatus(204);
        }
    }
    else {
        return $response->withStatus(404);
    }

});
