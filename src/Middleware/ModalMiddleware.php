<?php
/**
  * Haulage Management System - ModalMiddleware.php
  *
  * Middleware to show success modals
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

class ModalMiddleware extends Middleware{

  /**
    * Pass javascript to the view to force the modal to show.
    * @param request - The request object
    * @param response - The response object
    * @param next - The next middleware
  */
  public function __invoke($request, $response, $next){

    $response = $next($request, $response);

    if(isset($_SESSION['passwordSuccessModal'])){
      $response->getBody()->write("<script>$('#passwordSuccessModal').modal('show')</script>");
      unset($_SESSION['passwordSuccessModal']);
    }
		return $response;
  }
}

?>
