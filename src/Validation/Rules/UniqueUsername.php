<?php
/**
  * Haulage Management System - UniqueEmail.php
  *
  * Validation rule to ensure the username inputted is unique and doesn't already appear in the database
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

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class UniqueUsername extends AbstractRule{

  /**
    * Check that the username inputted does not already exist in the database
    * @param input - The form input to be validated
  */
  public function validate($input){

    // Check if  username is available
    return User::where('username', $input)->count() === 0;
  }
}

?>
