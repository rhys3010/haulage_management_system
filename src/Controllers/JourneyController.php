<?php
/**
  * Haulage Management System - Journey Controller
  *
  * @author Rhys Evans
  * @version 31/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class JourneyController extends Controller {

  public function getCreateJourney($request, $response){
    $this->container->view->render($response, 'create-journey.twig');
  }

  public function postCreateJourney($request, $response){

    $validation = $this->validator->validate($request, [
      // Valid Location
      'source' => v::notEmpty(),
      'destination' => v::notEmpty(),
      // Haulier exists
      'haulier' => v::notEmpty(),
      // Future?
      'datetime' => v::notEmpty(),
    ]);

    return $response->withRedirect($this->router->pathFor('journeys.add'));
  }
}

?>
