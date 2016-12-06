<?php

require "vendor/autoload.php";
require "bootstrap.php";


use Chatter\Models\Message;
use Chatter\Middleware\Logging AS ChatterLogging;
use Chatter\Middleware\Authentication AS ChatterAuth;

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
  ]
]);

$app->add(new ChatterAuth());
$app->add(new ChatterLogging());



// Routes
require "config/routes.php";

// Run the app
$app->run();
