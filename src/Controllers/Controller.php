<?php
/**
  * Haulage Management System - Base Controller
  *
  * @author Rhys Evans
  * @version 20/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Controllers;

/**
  * Base Controller class
  * All screen controller inherit from this class
*/
class Controller{

  // Container object
  protected $container;

  /**
    * Base constructor for all controllers
  */
  public function __construct($container){
    $this->container = $container;
  }

  /**
    * Get any container property
  */
  public function __get($property){
    if($this->container->{$property}){
      return $this->container->{$property};
    }
  }

}

?>
