<?php
/**
  * Haulage Management System - Form Validation Errors
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    if(isset($_SESSION['errors'])) {
			$this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
			unset($_SESSION['errors']);
		}

    $response = $next($request, $response);
		return $response;
  }
}

?>
