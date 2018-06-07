<?php
/**
  * Haulage Management System - SuccessMessageMiddleware.php
  *
  * Middleware to pass success message to twig environment view if form submission was successful
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

class SuccessMessageMiddleware extends Middleware{

  /**
    * Pass success message from session variable to twig environment.
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
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
