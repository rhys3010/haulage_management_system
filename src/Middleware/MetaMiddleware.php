<?php
/**
  * Haulage Management System - Meta Middleware
  *
  * @author Rhys Evans
  * @version 22/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class MetaMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    // Init meta array
    $meta = [];

    // Get version number from config
    $meta['version'] = $this->container->get('settings')['version'];
    $meta['googleAPI'] = $this->container->get('settings')['googleAPI'];

    // Set meta info environment variable and push to twig
    $_SESSION['meta'] = $meta;
    $this->container->view->getEnvironment()->addGlobal('meta', $_SESSION['meta']);

    $response = $next($request, $response);
		return $response;
  }
}

?>
