<?php
/**
  * Haulage Management System - Unique Username Exception
  *
  * @author Rhys Evans
  * @version 27/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class UniqueUsernameException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'This username is already in use',
    ],
  ];
}

?>
