<?php
/**
  * Haulage Management System - Success Message Middleware
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class SuccessMessageMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    if(isset($_SESSION['success'])){
      $this->container->view->getEnvironment()->addGlobal('success', $_SESSION['success']);
      unset($_SESSION['success']);
    }

    $response = $next($request, $response);
		return $response;
  }
}

?>
