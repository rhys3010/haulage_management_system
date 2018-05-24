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
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;


// Guest Access Group
$app->group('', function(){

  // Login
  $this->get('/', 'AuthController:getSignIn')->setName('auth.signin');
  $this->post('/', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

// Authed User Access group
$app->group('', function(){

  // Dashboard
  $this->get('/dashboard', 'DashboardController:index')->setName('dashboard');

  // Logout
  $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

  // Change Password
  $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
  $this->post('/auth/password/change', 'PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));



?>
