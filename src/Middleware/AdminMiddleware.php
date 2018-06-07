<?php
/**
  * Haulage Management System - AdminMiddleware.php
  *
  * Middleware to enforce Admin authing.
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

class AdminMiddleware extends Middleware{

  /**
    * Force the user to redirect back to dashboard if they access an admin page as non-admin
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    if (!$this->container->auth->checkAdmin()) {
      return $response->withRedirect($this->container->router->pathFor('dashboard'));
    }

    $response = $next($request, $response);
    return $response;
  }
}

?>
