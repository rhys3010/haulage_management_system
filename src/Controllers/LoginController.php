<?php
/**
  * Haulage Management System - Login Controller
  *
  * @author Rhys Evans
  * @version 20/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use \Slim\Views\Twig as View;

/**
  * Login Controller Class - Handle the login model and view
*/
class LoginController extends Controller {


  public function index($request, $response){

    $data = [
      'version' => $this->settings['version']
    ];

    return $this->container->view->render($response, 'login.twig', $data);
  }
}

?>
