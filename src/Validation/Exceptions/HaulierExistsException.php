<?php
/**
  * Haulage Management System - Location Exists Exception
  *
  * @author Rhys Evans
  * @version 03/06/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class HaulierExistsException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'The haulier you entered could not be found',
    ],
  ];
}

?>
