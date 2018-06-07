<?php
/**
  * Haulage Management System - AuthMiddleware.php
  *
  * Middleware to enforce access authentication.
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

class AuthMiddleware extends Middleware{

  /**
    * Force the guest to redirect back to login page if they access a page without being logged in
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    if (!$this->container->auth->check()) {
      return $response->withRedirect($this->container->router->pathFor('auth.signin'));
    }

    $response = $next($request, $response);
    return $response;
  }
}

?>
