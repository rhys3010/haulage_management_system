<?php
/**
  * Haulage Management System - Haulier Exists Validator
  *
  * @author Rhys Evans
  * @version 03/06/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Models\Haulier;
use Respect\Validation\Rules\AbstractRule;

class HaulierExists extends AbstractRule{

  public function validate($input){

    // Check if haulier exists
    return Haulier::where('id', $input)->count() > 0;
  }
}

?>
