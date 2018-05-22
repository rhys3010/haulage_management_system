<?php
/**
  * Haulage Management System - Authentication Erorrs Middleware
  *
  * @author Rhys Evans
  * @version 22/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class AuthErrorsMiddleware extends Middleware{

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
