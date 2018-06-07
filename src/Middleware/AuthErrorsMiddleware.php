<?php
/**
  * Haulage Management System - AuthErrorsMiddleware.php
  *
  * Pass any login auth errors to the view to allow for error messages
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

class AuthErrorsMiddleware extends Middleware{

  /**
    * Pass error session variable to twig view as globally accessible
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    if(isset($_SESSION['authError'])){
      $this->container->view->getEnvironment()->addGlobal('authError', $_SESSION['authError']);
      unset($_SESSION['authError']);
    }

    $response = $next($request, $response);
		return $response;
  }
}

?>
