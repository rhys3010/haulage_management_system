<?php
/**
  * Haulage Management System - ValidationErrorsMiddleware.php
  *
  * Middleware to pass error messages to twig environment view if form submission was unsuccessful
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

class ValidationErrorsMiddleware extends Middleware{

  /**
    * Pass error messages from session variable to twig environment.
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
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
