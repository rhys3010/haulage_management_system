<?php
/**
  * Haulage Management System - MetaMiddleware.php
  *
  * Middleware to pass meta values to the twig view (version number, etc)
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

class MetaMiddleware extends Middleware{

  /**
    * Assign meta values and pass to twig view as global
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    // Init meta array
    $meta = [];

    // Get version number from config
    $meta['version'] = $this->container->get('settings')['version'];

    // Set meta info environment variable and push to twig
    $_SESSION['meta'] = $meta;
    $this->container->view->getEnvironment()->addGlobal('meta', $_SESSION['meta']);

    $response = $next($request, $response);
		return $response;
  }
}

?>
