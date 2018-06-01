<?php

/**
  * Haulage Management System - Locations Controller
  *
  * @author Rhys Evans
  * @version 01/06/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

use App\Models\Location;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;

/**
  * Location Controller Class - Handle the locations model and view
*/
class LocationsController extends Controller {

  /**
    * Return an array of all locations
  */
  public function all(){
    return Location::get();
  }
}

?>
