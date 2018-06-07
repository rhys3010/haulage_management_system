<?php
/**
  * Haulage Management System - HaulierExists.php
  *
  * Validation rule to verify that the haulier being inputted exists in the database
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Validation\Rules;

use App\Models\Haulier;
use Respect\Validation\Rules\AbstractRule;

class HaulierExists extends AbstractRule{

  /**
    * Check that the haulier id entered exists within the database
    * @param input - The form input to be validated
  */
  public function validate($input){

    // Check if haulier exists
    return Haulier::where('id', $input)->count() > 0;
  }
}

?>
