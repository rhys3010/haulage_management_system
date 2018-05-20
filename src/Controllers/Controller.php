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

  // Program Version from settings
  protected $settings;

  public function __construct($container){
    $this->container = $container;
    $this->settings = $container->get('settings');
  }

}

?>
