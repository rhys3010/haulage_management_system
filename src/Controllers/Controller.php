<?php
/**
  * Haulage Management System - Controller.php
  *
  * The base view controller, all other controllers will extend this class.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Controllers;

class Controller{

  // Dependency Container object
  protected $container;

  /**
    * Controller constructor to initialize the container object
    * @param container - Slim's dependency container
  */
  public function __construct($container){
    $this->container = $container;
  }

  public function __get($property){
    if($this->container->{$property}){
      return $this->container->{$property};
    }
  }

}

?>
