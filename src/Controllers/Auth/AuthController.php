<?php
/**
  * Haulage Management System - Auth Controller
  *
  * @author Rhys Evans
  * @version 20/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

/**
  * Auth Controller Class - Handle the login model and view
*/
class AuthController extends Controller {

  public function getSignIn($request, $response){

    // Send version number from config
    $data = [
      'version' => $this->settings['version']
    ];

    return $this->view->render($response, 'login.twig', $data);
  }

  public function postSignIn($request, $response){

    $auth = $this->auth->attempt(
      $request->getParam('username'),
      $request->getParam('password')
    );

    if(!$auth){
      $_SESSION['authError'] = 'Invalid username or password';
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    return $response->withRedirect($this->router->pathFor('dashboard'));

  }
}

?>
