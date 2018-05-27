<?php
/**
  * Haulage Management System - Unique Username Validator
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class UniqueUsername extends AbstractRule{

  public function validate($input){

    // Check if  username is available
    return User::where('username', $input)->count() === 0;
  }
}

?>
