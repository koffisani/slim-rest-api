<?php

/**
* @author Koffi Sani <mailto:koffisani@gmail.com>
* @link https://koffisani.github.io
*
**/

use Chatter\Models\Message;
use Chatter\Middleware\FileFilter;
use Chatter\Middleware\FileMove;
use Chatter\Middleware\FileRemoveExif;



//Defines app routes
$app->get("/", function($request, $response, $args){
  return $response->write("Salut à tous");
});

$app->group('/messages', function(){
    
    $filter = new FileFilter();
    $removeExif = new FileRemoveExif();
    $move = new FileMove();

    $this->map(['GET'], '', function($request, $response, $args){
        $_message = new Message();
        $messages = $_message->all();

        $payload = [];
        foreach ($messages as $_msg) {
          $payload[$_msg->id] = [
            'body' => $_msg->body,
            'user_id' => $_msg->user_id,
            'user_uri' => '/user/' . $_msg->user_id,
            'created_at' => $_msg->created_at,
            'image_url' => $_msg->image_url,
            'message_id' => $_msg->id,
            'message_uri' => '/messages/'. $_msg->id
          ];
        }
        return $response->withStatus(200)->withJSon($payload);
        //return $response->write("This is our list of messages");
    });

    $this->map(['POST'], '', function($request, $response, $args){
        $_message = $request->getParsedBodyParam('message', '');

        $imagepath = '';
        $message = new Message();
        $message->body = $_message;
        $message->user_id = -1;
        $message->image_url = $request->getAttribute('png_filename');
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
    })->add($filter)->add($removeExif)->add($move);

    $this->map(['DELETE'], '', function($request, $response, $args){
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
});

$app->delete('/messages/{message_id}', function($request, $response, $args){


});
