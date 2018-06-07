<?php
/**
  * Haulage Management System - DashboardController.php
  *
  * The controller class for the Dashboard view.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;


class DashboardController extends Controller {

  /**
    * Render the dashboard view
    * @param request - The request object
    * @param response - The response object
  */
  public function index($request, $response){
    $this->container->view->render($response, 'dashboard.twig');
  }
}

?>
