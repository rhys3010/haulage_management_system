<?php
/**
  * Haulage Management System - Auth Middleware
  *
  * @author Rhys Evans
  * @version 23/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class AuthMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    if (!$this->container->auth->check()) {
      return $response->withRedirect($this->container->router->pathFor('auth.signin'));
    }

    $response = $next($request, $response);
    return $response;
  }
}

?>
