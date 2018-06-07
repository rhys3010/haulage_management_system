<?php
/**
  * Haulage Management System - LocationsController.php
  *
  * The controller class for locations view.
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

use App\Models\Location;
use \Slim\Views\Twig as View;
use Respect\Validation\Validator as v;


class LocationsController extends Controller {

  /**
    * Get all the location entries in the table
    * @return locations - all location entries
  */
  public function all(){
    return Location::get();
  }
}

?>
