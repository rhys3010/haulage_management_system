<?php

/**
  * Haulage Management System - Dashboard Controller
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;

/**
  * Dashboard Controller Class - Handle the dashboard model and view
*/
class DashboardController extends Controller {

  public function index($request, $response){

    $this->container->view->render($response, 'dashboard.twig');

    // If password was changed
    echo "<script>$('#passwordSuccessModal').modal('show')</script>";
  }
}

?>
