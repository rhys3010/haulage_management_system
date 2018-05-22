<?php
/**
  * Haulage Management System - Main File
  *
  * @author Rhys Evans
  * @version 19/05/2018
  * 2018 (C) Rhys Evans
*/

session_start();

/**
  * @var Slim\App $app
*/
$app = require __DIR__ . '/../config/bootstrap.php';


// Start
$app->run();

?>
