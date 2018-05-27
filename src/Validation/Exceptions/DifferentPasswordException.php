<?php
/**
  * Haulage Management System - Different Password Validation Exception
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class DifferentPasswordException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'New password must be different to current password',
    ],
  ];
}

?>
