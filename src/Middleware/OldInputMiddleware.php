<?php
/**
  * Haulage Management System - OldInputMiddleware.php
  *
  * Middleware to persist old form inputs to be shown after submission failure.
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

class OldInputMiddleware extends Middleware{

  /**
    * Add old input from session variable to twig view global
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
    $_SESSION['old'] = $request->getParams();

    $response = $next($request, $response);
		return $response;
  }
}

?>
