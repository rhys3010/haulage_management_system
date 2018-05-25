<?php
/**
  * Haulage Management System - Unique Haulier Validation Exception
  *
  * @author Rhys Evans
  * @version 25/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class UniqueHaulierException extends ValidationException{

  public static $defaultTemplates = [
    self::MODE_DEFAULT => [

      self::STANDARD => 'This Haulier Already Exists.',
    ],
  ];
}

?>
