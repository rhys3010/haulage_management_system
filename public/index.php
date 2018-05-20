<?php
/**
  * Haulage Management System - Front Controller
  *
  * @author Rhys Evans
  * @version 19/05/2018
  * 2018 (C) Rhys Evans
*/

/**
  * @var Slim\App $app
*/
$app = require __DIR__ . '/../config/bootstrap.php';

// Start
$app->run();

?>
