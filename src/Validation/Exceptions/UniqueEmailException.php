<?php
/**
  * Haulage Management System - Unique Email Exception
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class UniqueEmailException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'This email is already in use',
    ],
  ];
}

?>
