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
use Respect\Validation\Validator as v;

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
      // Enter Log
      $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' removed user: ' . User::find($request->getParam('id'))->username;
      $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

      // Remove user
      $user = User::destroy($request->getParam('id'));
    }

    return $response->withRedirect($this->router->pathFor('admin.manage'));
  }

  public function postAdduser($request, $response){

    $validation = $this->validator->validate($request, [
      'name' => v::notEmpty()->length(2, 255),
      'email' => v::notEmpty()->noWhitespace()->uniqueEmail(),
      'username' => v::notEmpty()->noWhitespace()->uniqueUsername(),
      'password' => v::notEmpty()->passwordsMatch($request->getParam('password-confirm')),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('admin.register'));
    }

    // Create the new user
    $user = User::create([
      'username' => $request->getParam('username'),
      'password'=> password_hash($request->getParam('password'), PASSWORD_DEFAULT),
      'name' => $request->getParam('name'),
      'email'=>$request->getParam('email'),
    ]);

    // Success behaviour
    $_SESSION['success'] = 'User ' . $user->username . ' Created Successfully';
    unset($_SESSION['old']);

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' addded user: ' . $request->getParam('username');
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    return $response->withRedirect($this->router->pathFor('admin.register'));
  }
}

?>
