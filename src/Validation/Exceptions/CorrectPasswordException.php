<?php
/**
  * Haulage Management System - Password Correct Validation Exception
  *
  * @author Rhys Evans
  * @version 24/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class CorrectPasswordException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'Current Password is Incorrect',
    ],
  ];
}

?>
