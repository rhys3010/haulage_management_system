<?php

/**
  * Haulage Management System - Dashboard Controller
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use \Slim\Views\Twig as View;

/**
  * Dashboard Controller Class - Handle the dashboard model and view
*/
class DashboardController extends Controller {


  public function index($request, $response){


    /*
    $user = $this->container->db->table('users')->find(6);

    var_dump($user->email);

    die();*/

    $data = [
      'version' => $this->settings['version']
    ];

    return $this->container->view->render($response, 'dashboard.twig', $data);
  }
}

?>
