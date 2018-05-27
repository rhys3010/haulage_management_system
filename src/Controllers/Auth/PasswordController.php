<?php
/**
  * Haulage Management System - Password Change Controller
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller{

  public function getChangePassword($request, $response){

    return $this->view->render($response, 'password.twig');
  }

  public function postChangePassword($request, $response){
    $validation = $this->validator->validate($request, [

      // Make sure current password is correct
      'passwordOld' => v::noWhitespace()->notEmpty()->correctPassword($this->auth->user()->password),
      // Make sure new passwords match
      'passwordNew' => v::noWhitespace()->notEmpty()->passwordsMatch($request->getParam('passwordNewConfirm'))->differentPassword($this->auth->user()->password),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('auth.password.change'));
    }

    // Change the password
    $this->auth->user()->setPassword($request->getParam('passwordNew'));

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' changed their password';
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    $_SESSION['passwordSuccessModal'] = true;


    return $response->withRedirect($this->router->pathFor('dashboard'));
  }



}

?>
