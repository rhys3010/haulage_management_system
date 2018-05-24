<?php

/**
  * Haulage Management System - Hauliers Controller
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;

/**
  * Hauliers Controller Class - Handle the hauliers model and view
*/
class HauliersController extends Controller {

  public function index($request, $response){

    $this->container->view->render($response, 'hauliers.twig');
  }
}

?>
