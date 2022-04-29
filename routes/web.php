<?php

use Framework\Request\Request;
use Framework\Request\Router;
use App\Http\Controller\HomeController;
use App\Http\Controller\ProjectController;

$router = new Router(new Request);

$router->get('/', function() {
//    die(var_dump(new HomeController()));
    return <<<HTML
      <h1>Hello world</h1>
HTML;
})->middleware('web');

//$router->get('/', );


$router->get('/profile', function($request) {
    return <<<HTML
  <h1>Profile</h1>
HTML;
});

$router->get('/test', "HomeController@index");

$router->get('/project', [ProjectController::class, 'index']);
$router->get('/single_project', [ProjectController::class, 'show']);

$router->post('/data', function($request) {
  return json_encode($request->getBody());
});