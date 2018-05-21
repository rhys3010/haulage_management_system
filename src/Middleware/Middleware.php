<?php
/**
  * Haulage Management System - Middleware File
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Middleware;

class Middleware{

  protected $container;

  public function __construct($container){
    $this->container = $container;
  }
}

?>
