<?php
/**
  * Haulage Management System - JourneyController.php
  *
  * Controller to handle the journey views (individual and all)
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

use Carbon\Carbon;
use App\Models\User;
use App\Models\Journey;
use App\Models\Location;
use App\Models\Haulier;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

class JourneyController extends Controller {

  /**
    * Render the journeys view
    * @param request - The request object
    * @param response - The response object
  */
  public function getViewJourneys($request, $response){
    $this->container->view->render($response, 'journeys.twig');
  }

  /**
    * Render the individual journey view
    * @param request - The request object
    * @param response - The response object
    * @param args - The http arguments from the request
  */
  public function getViewIndividualJourney($request, $response, $args){

    $journey = Journey::find($args['id']);

    // Pass the journey data to the twig view
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


  /**
    * Render the create journey form view
    * @param request - The request object
    * @param response - The response object
  */
  public function getCreateJourney($request, $response){
    $this->container->view->render($response, 'create-journey.twig');
  }

  /**
    * Handle the form submission to create a journey
    * @param request - The request object
    * @param response - The response object
    * @return response - Redirected response to create journey view
  */
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

    // Create the journey entry
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

  /**
    * Handle the form submission to remove a journey (called from confirmation modal)
    * @param request - The request object
    * @param response - The response object
    * @return response - Redirected response to create journey view
  */
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

  /**
    * Get the amount of journeys logged per day in the last week using carbon and eloquent
    * @param request - The request object
    * @param response - The response object
    * @return noJourneys - Number of journeys logged over last 7 days in json format
  */
  public function getDailyLoggedJourneys($request, $response){

    $data_output = array();

    for($i = 7; $i >= 0; $i--){
      $date = Carbon::now()->subDay($i)->format('d F');
      $noJourneys = Journey::whereRaw('date(created_at) = ?', [Carbon::today()->subDays($i)])->count();

      array_push($data_output, array(
        'date' => $date,
        'noJourneys' => $noJourneys
      ));

    }
    // Return AJAX
    return json_encode($data_output);
  }

  /**
    * Get all the journey data to display in Datatable through Ajax
    * @param request - The request object
    * @param response - The response object
    * @return journeys - All journeys in json format
  */
  public function getAllJourneysData($request, $response){
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
}
?>
