<?php
/**
  * Haulage Management System - Unique Haulier Validator
  *
  * @author Rhys Evans
  * @version 25/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Models\Haulier;
use Respect\Validation\Rules\AbstractRule;

class UniqueHaulier extends AbstractRule{

  public function validate($input){

    // Check if haulier name is available
    return Haulier::where('short_name', $input)->count() === 0;
  }
}

?>
