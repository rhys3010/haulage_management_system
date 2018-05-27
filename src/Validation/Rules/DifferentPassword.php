<?php
/**
  * Haulage Management System - Different Password Validator
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Rules;

use App\Modals\User;
use Respect\Validation\Rules\AbstractRule;

class DifferentPassword extends AbstractRule{

  protected $password;

  public function __construct($password){
    $this->password = $password;
  }

  public function validate($input){

    return !password_verify($input, $this->password);
  }
}

?>
