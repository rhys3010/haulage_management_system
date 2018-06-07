<?php
/**
  * Haulage Management System - PasswordController.php
  *
  * Controller to handle the change password modal view
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

class PasswordController extends Controller{

  /**
    * Handle the get request to render change password view
    * @param request - The request object
    * @param response - The response object
  */
  public function getChangePassword($request, $response){

    return $this->view->render($response, 'password.twig');
  }

  /**
    * Handle the post request to change password
    * @param request - The request object
    * @param response - The response object
  */
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
