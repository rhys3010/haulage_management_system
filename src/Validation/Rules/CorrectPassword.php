<?php
/**
  * Haulage Management System - Correct Password Validator
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Modals\User;
use Respect\Validation\Rules\AbstractRule;

class CorrectPassword extends AbstractRule{

  protected $password;

  public function __construct($password){
    $this->password = $password;
  }

  public function validate($input){

    return password_verify($input, $this->password);
  }
}

?>
