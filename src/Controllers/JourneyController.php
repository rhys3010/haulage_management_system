<?php
/**
  * Haulage Management System - Journey Controller
  *
  * @author Rhys Evans
  * @version 31/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\User;
use App\Models\Journey;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class JourneyController extends Controller {

  public function getCreateJourney($request, $response){
    $this->container->view->render($response, 'create-journey.twig');
  }

  public function postCreateJourney($request, $response){

    // Validate Input
    $validation = $this->validator->validate($request, [
      'source' => v::notEmpty()->locationExists(),
      'destination' => v::notEmpty()->locationExists(),
      'haulier' => v::notEmpty()->haulierExists(),
      'datetime' => v::notEmpty(),
    ]);

    if($validation->failed()){
      return $response->withRedirect($this->router->pathFor('journeys.add'));
    }

    $journey = Journey::create([
      'source'  => $request->getParam('source'),
      'destination' => $request->getParam('destination'),
      'haulier' => $request->getParam('haulier'),
      'datetime' => $request->getParam('datetime'),
    ]);

    // Success Behaviour
    $_SESSION['success'] = 'Journey Logged Successfully';

    // Enter Log
    $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' logged journey: #' . $journey->id;
    $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

    return $response->withRedirect($this->router->pathFor('journeys.add'));
  }
}

?>
