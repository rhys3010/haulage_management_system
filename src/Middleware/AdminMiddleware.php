<?php
/**
  * Haulage Management System - Admin Middleware
  *
  * @author Rhys Evans
  * @version 25/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class AdminMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    if (!$this->container->auth->checkAdmin()) {
      return $response->withRedirect($this->container->router->pathFor('dashboard'));
    }

    $response = $next($request, $response);
    return $response;
  }
}

?>
