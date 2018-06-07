<?php
/**
  * Haulage Management System - DifferentPasswordException.php
  *
  * Validation exception to handle the DifferentPassword rule
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  * @see DifferentPassword.php
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
