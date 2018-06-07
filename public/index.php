<?php
/**
  * Haulage Management System - index.php
  *
  * Slim's entry php file, simply starts the php session and runs the slim app.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

session_start();

/**
  * @var Slim\App $app
*/
$app = require __DIR__ . '/../config/bootstrap.php';


// Start
$app->run();

?>
