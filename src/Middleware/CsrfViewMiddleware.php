<?php
/**
  * Haulage Management System - CsrfViewMiddleware.php
  *
  * Middleware to pass csrf input fields.
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

class CsrfViewMiddleware extends Middleware{

  /**
    * Pass the csrf html input forms to the twig view as global
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    $this->container->view->getEnvironment()->addGlobal('csrf', [

      'field' => '
        <input type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" value="' . $this->container->csrf->getTokenName() . '">
        <input type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" value="' . $this->container->csrf->getTokenValue() . '">
      ',

    ]);

    $response = $next($request, $response);
    return $response;
  }
}

?>
