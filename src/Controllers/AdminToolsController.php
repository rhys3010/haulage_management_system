<?php

/**
  * Haulage Management System - Admin Tools Controller
  *
  * @author Rhys Evans
  * @version 25/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View;

class AdminToolsController extends Controller {

  public function getManageUsers($request, $response){

    $this->container->view->render($response, 'manage-users.twig');
  }

  public function getRegisterUser($request, $response){

    $this->container->view->render($response, 'register-user.twig');
  }

  public function postRemoveUser($request, $response){

    $user = User::find($request->getParam('id'));

    // Check that user to be removed isnt an admin
    if(!$user->admin){
      $user = User::destroy($request->getParam('id'));
    }

    return $response->withRedirect($this->router->pathFor('admin.manage'));
  }
}

?>
