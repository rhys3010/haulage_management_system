<?php
/**
  * Haulage Management System - Routtes File
  *
  * @author Rhys Evans
  * @version 19/05/2018
  * 2018 (C) Rhys Evans
*/

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("It works! This is the default welcome page.");

    return $response;
})->setName('root');

$app->get('/test', function (Request $request, Response $response){
  $viewData = [
    'message' => 'Hello World'
  ];

  return $this->get('view')->render($response, 'test.twig', $viewData);
})

?>
