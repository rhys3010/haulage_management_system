<?php
/**
  * Haulage Management System - Unique Email Validator
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class UniqueEmail extends AbstractRule{

  public function validate($input){

    // Check if  email is available
    return User::where('email', $input)->count() === 0;
  }
}

?>
