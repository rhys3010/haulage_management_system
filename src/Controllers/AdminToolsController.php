<?php
/**
  * Haulage Management System - AdminToolsController.php
  *
  * Controller to handle the admin tools views available from the nav.
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
use Respect\Validation\Validator as v;

class AdminToolsController extends Controller {

  /**
    * Render the users table and user management view
    * @param request - The request object
    * @param response - The response object
  */
  public function getManageUsers($request, $response){
    $this->container->view->render($response, 'manage-users.twig');
  }

  /**
    * Render the user registration view and form
    * @param request - The request object
    * @param response - The response object
  */
  public function getRegisterUser($request, $response){
    $this->container->view->render($response, 'register-user.twig');
  }

  /**
    * Handle the form submission for user deletion (submitted from confirmation modal)
    * @param request - The request object
    * @param response - The response object
    * @return response - Redirected response to user management page
  */
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

  /**
    * Handle the form submission for user registration from the main form
    * and deal with validation and loggin etc
    * @param request - The request object
    * @param response - The response object
    * @return response - Redirected response to user registration page
  */
  public function postAdduser($request, $response){

    // Validate form 
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
