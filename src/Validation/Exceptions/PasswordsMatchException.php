<?php
/**
  * Haulage Management System - Passwords Match Validation Exception
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class PasswordsMatchException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'Passwords must match',
    ],
  ];
}

?>
