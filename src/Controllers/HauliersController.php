<?php
/**
  * Haulage Management System - HauliersController.php
  *
  * The controller class for hauliers view, handles haulier list and haulier registration
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

use App\Models\Haulier;
use App\Models\User;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;


class HauliersController extends Controller {

  /**
    * Render the hauliers view
    * @param request - The request object
    * @param response - The response object
  */
  public function getHauliers($request, $response){
    $this->container->view->render($response, 'hauliers.twig');
  }

  /**
    * Handle form submission of new haulier registration
    * @param request - The request object
    * @param response - The response object
    * @param response - Redirected response to hauliers page
  */
  public function postAddHaulier($request, $response){

    // Validate Form
    $validation = $this->validator->validate($request, [
      'short_name' => v::notEmpty()->length(2, 10)->uniqueHaulier(),
      'name' => v::notEmpty()->length(3, 255),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('hauliers'));
    }

    $haulier = Haulier::create([
      'short_name' => $request->getParam('short_name'),
      'name' => $request->getParam('name'),
    ]);

    // Success Behaviour
    $_SESSION['success'] = 'Haulier '. $haulier->short_name .' Created Successfully';

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' registered haulier: ' . $request->getParam('short_name');
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    return $response->withRedirect($this->router->pathFor('hauliers'));
  }

  /**
    * Handle form submission of haulier deletion (submitted from confirmation modal)
    * @param request - The request object
    * @param response - The response object
    * @param response - Redirected response to hauliers page
  */
  public function postRemoveHaulier($request, $response){

    if($this->container->auth->checkAdmin()){

      // Enter Log
      $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' deleted haulier: ' . Haulier::find($request->getParam('id'))->short_name;
      $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

      // Remove the haulier
      $haulier = Haulier::destroy($request->getParam('id'));
    }

    return $response->withRedirect($this->router->pathFor('hauliers'));
  }

  /**
    * Get all hauliers
    * @param hauliers - All haulier entries
  */
  public function all(){
    return Haulier::get();
  }
}

?>
