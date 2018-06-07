<?php
/**
  * Haulage Management System - AuthController.php
  *
  * Controller to handle HTTP GET and POST methods of the auth views (sign out / sign in)
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller {

  /**
    * Handle the router's signout method
    * @param request - The request object
    * @param response - The response object
  */
  public function getSignOut($request, $response){

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' logged out.';
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    // Logout
    $this->auth->logout();

    return $response->withRedirect($this->router->pathFor('auth.signin'));
  }

  /**
    * Handle the router's sign in get method by rendering the login view
    * @param request - The request object
    * @param response - The response object
  */
  public function getSignIn($request, $response){

    return $this->view->render($response, 'login.twig');
  }

  /**
    * Handle the router's sign in post method by attempting to log the user in and handling validation etc
    * @param request - The request object
    * @param response - The response object
  */
  public function postSignIn($request, $response){

    $auth = $this->auth->attempt(
      $request->getParam('username'),
      $request->getParam('password')
    );

    if(!$auth){
      $_SESSION['authError'] = 'Invalid username or password';
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' logged in';
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    return $response->withRedirect($this->router->pathFor('dashboard'));

  }
}

?>
