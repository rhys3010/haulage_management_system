<?php
/**
  * Haulage Management System - GuestMiddleware.php
  *
  * Middleware to handle authenticated users and always redirect them to dashboard
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Middleware;

class GuestMiddleware extends Middleware{

  /**
    * Force authed users to the dashboard so they don't have to manually navigate there
    * from signin page
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
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
