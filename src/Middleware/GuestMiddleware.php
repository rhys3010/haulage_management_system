<?php
/**
  * Haulage Management System - Guest Middleware
  *
  * @author Rhys Evans
  * @version 23/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class GuestMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    // Verify the user is signed in and display dashboard
		if ($this->container->auth->check()) {
			return $response->withRedirect($this->container->router->pathFor('dashboard'));
		}

    $response = $next($request, $response);
    return $response;
  }
}

?>
