<?php
/**
  * Haulage Management System - Modal Popups Middleware
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class ModalMiddleware extends Middleware{

  public function __invoke($request, $response, $next){

    $response = $next($request, $response);

    if(isset($_SESSION['passwordSuccessModal'])){
      var_dump('works');
      $response->getBody()->write("<script>$('#passwordSuccessModal').modal('show')</script>");
      unset($_SESSION['passwordSuccessModal']);
    }
		return $response;
  }
}

?>
