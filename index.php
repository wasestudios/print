<?php

  define('INDEX_DIR',true);
  header('Access-Control-Allow-Origin: *');    
  header('Access-Control-Request-Method: GET');
  header('Access-Control-Request-Method: POST');

  require('core/api_core.php');

  //------------------------------------------------
  $app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);
  $c = $app->getContainer();
  $c['notAllowedHandler'] = function ($c) {
      return function ($request, $response, $methods) use ($c) {
          return $c['response']
              ->withStatus(405)
              ->withHeader('Allow', implode(', ', $methods))
              ->withHeader('Content-type', 'text/html')
              ->write('Method must be one of: ' . implode(', ', $methods));
      };
  };

  # Peticiones GET
  if($_GET) {
    include('http/get.php');
  }

  # Peticiones POST
  if($_POST) {
    include('http/post.php');
  }

  $app->run();
?>