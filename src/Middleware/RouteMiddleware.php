<?php
/**
  * Haulage Management System - Route Middleware
  *
  * @author Rhys Evans
  * @version 29/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class RouteMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    $_SESSION['route'] = $request->getAttribute('route')->getName();
    $this->container->view->getEnvironment()->addGlobal('route', $_SESSION['route']);

    $response = $next($request, $response);
    return $response;
  }
}

?>
