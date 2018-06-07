<?php
/**
  * Haulage Management System - bootstrap.php
  *
  * Iniitalize the slim app and handle all the dependencies.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

  require_once __DIR__ . '/../vendor/autoload.php';

  // Instantiate the app
  $app = new \Slim\App(['settings' => require __DIR__ . '/../config/settings.php']);

  // Set up dependencies
  require  __DIR__ . '/container.php';

  // Register routes
  require __DIR__ . '/routes.php';

  return $app;
?>
