<?php
/**
  * Haulage Management System - Routes File
  *
  * @author Rhys Evans
  * @version 19/05/2018
  * 2018 (C) Rhys Evans
*/

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', 'LoginController:index');


?>
