<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

use Firebase\JWT\JWT;
require('../vendor/autoload.php');

require('./assetService.php');


$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});


$app->get('/api/login', function() use($app) {
  $responseObject = array("Status"=> "Authenticated", "Token"=> getJWT());

  return json_encode($responseObject);
});

$app->get('/api/assets', function() use($app) {
  
  if(!validateToken()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
  }

  $assetService = new AssetService();
  $data = $assetService->GetAll($_GET);

  return json_encode($data);
});


$app->get("/api/assets/{id}", function ($id) use ($app) {

  if(!validateToken()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
  }


  $assetService = new AssetService();
  $data = $assetService->GetOne($id);
  
  return json_encode($data);
});


$app->post("/api/assets", function ($data) use ($app) {

  if(!validateToken()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
  }


  $assetService = new AssetService();
  $data = $assetService->insert($_POST);
  
  return json_encode($data);
});

$app->post("/api/assets", function ($data) use ($app) {

  if(!validateToken()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
  }

  $assetService = new AssetService();
  $data = $assetService->update($_POST, $_POST["id"]);
  
  return json_encode($data);
});


$app->delete("/api/assets/{id}", function ($id) use ($app) {

  if(!validateToken()) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
  }

  $assetService = new AssetService();
  $data = $assetService->delete($id);
  
  return json_encode($data);
});

$app->run();



