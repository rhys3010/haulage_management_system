<?php
/**
  * Haulage Management System - Validation Errors
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    if(isset($_SESSION['errors'])){
      $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
      unset($S_SESSION['errors']);
    }

    $response = $next($request, $response);

    return $response;
  }
}

?>
