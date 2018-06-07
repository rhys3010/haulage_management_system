<?php
/**
  * Haulage Management System - UniqueEmail.php
  *
  * Validation rule to ensure the haulier inputted is unique and doesn't already appear in the database
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

class UniqueHaulier extends AbstractRule{

  /**
    * Check that the haulier inputted does not already exist in the database
    * @param input - The form input to be validated
  */
  public function validate($input){

    // Check if haulier name is available
    return Haulier::where('short_name', $input)->count() === 0;
  }
}

?>
