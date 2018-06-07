<?php
/**
  * Haulage Management System - Middleware.php
  *
  * Base middleware class - all other middlware within the system will inherit from this class.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Middleware;

class Middleware{

  protected $container;

  /**
    * Construct the middleware by initializing the container object
    * @param container - The dependency container object
  */
  public function __construct($container){
    $this->container = $container;
  }
}

?>
