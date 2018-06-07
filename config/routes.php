<?php
/**
  * Haulage Management System - routes.php
  *
  * The project's router, this is where all the routes are grouped and added. The router is split into three groups:
  *  > Guest
  *  > Authed
  *  > Admin
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

use Slim\Http\Request;
use Slim\Http\Response;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\ModalMiddleware;
use App\Middleware\AdminMiddleware;


// Guest Access Group
$app->group('', function(){

  // Login
  $this->get('/', 'AuthController:getSignIn')->setName('auth.signin');
  $this->post('/', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));

// Authed User Access group
$app->group('', function(){

  // Dashboard
  $this->get('/dashboard', 'DashboardController:index')->setName('dashboard')->add(new ModalMiddleware($this->getContainer()));

  // Logout
  $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

  // Change Password
  $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
  $this->post('/auth/password/change', 'PasswordController:postChangePassword');

  // Hauliers View, Add
  $this->get('/hauliers', 'HauliersController:getHauliers')->setName('hauliers');
  $this->post('/hauliers/add', 'HauliersController:postAddHaulier')->setName('hauliers.add');

  // Feedback Submission
  $this->get('/feedback', 'FeedbackController:getFeedback')->setName('feedback');
  $this->post('/feedback/submit', 'FeedbackController:postFeedback')->setName('feedback.submit');

  // Create Journey
  $this->get('/journeys/add', 'JourneyController:getCreateJourney')->setName('journeys.add');
  $this->post('/journeys/add', 'JourneyController:postCreateJourney');

  // View journeys
  $this->get('/journeys/view', 'JourneyController:getViewJourneys')->setName('journeys.view');
  $this->get('/journeys/view/{id}', 'JourneyController:getViewIndividualJourney');

  // Journey Data
  $this->get('/journeys/allJourneysData', 'JourneyController:getAllJourneysData')->setName('journeys.allJourneysData');
  $this->get('/journeys/dailyJourneysData', 'JourneyController:getDailyLoggedJourneys')->setName('journeys.dailyJourneysData');

  // Changelog
  $this->get('/changelog', 'ChangelogController:getChangelog')->setName('changelog');


})->add(new AuthMiddleware($container));


// Admin Access
$app->group('', function(){

  // Remove Hauliers
  $this->post('/hauliers/remove', 'HauliersController:postRemoveHaulier')->setName('hauliers.remove');

  // Remove Journeys
  $this->post('/journeys/remove', 'JourneyController:postRemoveJourney')->setName('journeys.remove');

  // Admin Tools
  $this->get('/admin/manage-users', 'AdminToolsController:getManageUsers')->setName('admin.manage');
  $this->get('/admin/register', 'AdminToolsController:getRegisterUser')->setName('admin.register');

  $this->post('/admin/user/remove', 'AdminToolsController:postRemoveUser')->setName('admin.user.remove');
  $this->post('/admin/user/add', 'AdminToolsController:postAddUser')->setName('admin.user.add');

})->add(new AdminMiddleware($container));



?>
