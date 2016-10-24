<?php

require "vendor/autoload.php";
require "bootstrap.php";


use Chatter\Models\Message;
use Chatter\Middleware\Logging AS ChatterLogging;

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
  ]
]);

$app->add(new ChatterLogging());

// Routes
require "config/routes.php";

// Run the app
$app->run();
