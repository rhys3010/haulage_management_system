<?php

/**
  * Haulage Management System - Hauliers Controller
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\Haulier;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

/**
  * Hauliers Controller Class - Handle the hauliers model and view
*/
class HauliersController extends Controller {

  public function getHauliers($request, $response){

    $this->container->view->render($response, 'hauliers.twig');
  }

  public function postAddHaulier($request, $response){

    $validation = $this->validator->validate($request, [
      'short_name' => v::notEmpty()->length(2, 10),
      'name' => v::notEmpty()->length(3, 255),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('hauliers'));
    }

    $haulier = Haulier::create([
      'short_name' => $request->getParam('short_name'),
      'name' => $request->getParam('name'),
    ]);

    return $response->withRedirect($this->router->pathFor('hauliers'));

  }

  public function postRemoveHaulier($request, $response){

    // Remove the haulier
    $haulier = Haulier::destroy($request->getParam('id'));

    return $response->withRedirect($this->router->pathFor('hauliers'));
  }

  /**
    * Return an array of all hauliers
  */
  public function all(){
    return Haulier::get();
  }

  public function add(){

  }


}

?>
