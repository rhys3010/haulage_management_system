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
use App\Models\Location;
use App\Models\Haulier;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class JourneyController extends Controller {

  // Show the html view for journeys
  public function getViewJourneys($request, $response){
    $this->container->view->render($response, 'journeys.twig');
  }

  public function getViewIndividualJourney($request, $response, $args){

    $journey = Journey::find($args['id']);

    $data = array (
      'journey' => array(
        'journey' => $journey,
        'sourceName' => Location::where('area_code', $journey->source)->value('name'),
        'destName' => Location::where('area_code', $journey->destination)->value('name'),
        'haulierName' => Haulier::where('id', $journey->haulier)->value('short_name'),
      )
    );

    return $this->container->view->render($response, 'individual-journey.twig', $data);
  }

  // Get the journeys from SQL
  public function getData($request, $response){
    // Get all journeys
    $journeys = Journey::get();
    $data_output = array();

    // Format data from SQL correctly
    foreach($journeys as $journey){
      $row = array();
      $id = $journey->id;
      $source = $journey->source . ' (' . Location::where('area_code', $journey->source)->value('name') . ')';
      $destination = $journey->destination . ' (' . Location::where('area_code', $journey->destination)->value('name') . ')';
      $haulier = Haulier::where('id', $journey->haulier)->value('short_name');
      $datetime = $journey->datetime;

      array_push($row, $id, $source, $destination, $haulier, $datetime);
      array_push($data_output, $row);
    }

    // Return AJAX
    return json_encode(array(
      "draw" => 1,
      "recordsTotal" => count($journeys),
      "recordsFiltered" => count($journeys),
      "data" => $data_output,
    ));
  }

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

  public function postRemoveJourney($request, $response){

    if($this->container->auth->checkAdmin()){
      // Enter Log
      $logMessage = 'User ' . User::find($_SESSION['user'])->username . ' deleted journey: #' . Journey::find($request->getParam('id'))->id;
      $this->container->logger->info($logMessage, array('ip' => $request->getAttribute('ip_address')));

      // Remove the journey
      $journey = Journey::destroy($request->getParam('id'));
    }

    return $response->withRedirect($this->router->pathFor('journeys.view'));
  }

}

?>
