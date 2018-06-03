<?php
/**
  * Haulage Management System - Location Exists Validator
  *
  * @author Rhys Evans
  * @version 03/06/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Models\Location;
use Respect\Validation\Rules\AbstractRule;

class LocationExists extends AbstractRule{

  public function validate($input){

    // Check if location exists
    return Location::where('area_code', $input)->count() > 0;
  }
}

?>
