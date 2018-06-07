<?php
/**
  * Haulage Management System - RouteMiddleware.php
  *
  * Middleware to keep track of current route.
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

class RouteMiddleware extends Middleware{

  /**
    * Get the current route and assign it to twig environment variable
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    if($request->getAttribute('route') != NULL){
      $_SESSION['route'] = $request->getAttribute('route')->getName();
      $this->container->view->getEnvironment()->addGlobal('route', $_SESSION['route']);
    }

    $response = $next($request, $response);
    return $response;
  }
}

?>
