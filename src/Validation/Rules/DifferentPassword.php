<?php
/**
  * Haulage Management System - DifferentPassword.php
  *
  * Validation rule to verify that the new password inputted in the 'change password' form
  * differs from the currently stored password
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

use App\Modals\User;
use Respect\Validation\Rules\AbstractRule;

class DifferentPassword extends AbstractRule{

  protected $password;

  /**
    * Constructor to initialize the password variable
    * @param password - The user's hashed password
  */
  public function __construct($password){
    $this->password = $password;
  }

  /**
    * Check that the user's input does not match their currently stored password
    * @param input - The form input to be validated
  */
  public function validate($input){

    return !password_verify($input, $this->password);
  }
}

?>
