<?php
/**
  * Haulage Management System - PasswordsMatch.php
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

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class PasswordsMatch extends AbstractRule{

  // The first password inputted into the form
  protected $password;

  /**
    * Constructor to initialize the password variable
    * @param password - The user's hashed password
  */
  public function __construct($password){
    $this->password = $password;
  }

  /**
    * Check that the user's input for the second password matches the first password
    * ()'Password: ' and 'Confirm Password')
    * @param input - The form input to be validated
  */
  public function validate($input){

    return $input == $this->password;
  }
}

?>
