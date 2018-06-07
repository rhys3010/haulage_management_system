<?php
/**
  * Haulage Management System - container.php
  *
  * Create and manage the dependecy container for this project
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

use Slim\Container;
use Respect\Validation\Validator as v;

/** @var \Slim\App $app */
$container = $app->getContainer();

// Activating routes in a subfolder
$container['environment'] = function () {
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $_SERVER['SCRIPT_NAME'] = dirname(dirname($scriptName)) . '/' . basename($scriptName);
    return new Slim\Http\Environment($_SERVER);
};

/**
  * DEPENDENCIES
*/

// Auth Container
$container['auth'] = function($container){
  return new \App\Auth\Auth;
};

// Logger Container
$container['logger'] = function($container){
  $settings = $container['settings']['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  // Setup the rotatingfile handler
  $logger->pushHandler(new Monolog\Handler\RotatingFileHandler($settings['path'], 0, $settings['level'], false, 0644, true));
  return $logger;
};

// Mailer Container
$container['mailer'] = function($container){
  $settings = $container['settings']['mail'];

  $mailer = new PHPMailer\PHPMailer\PHPMailer(true);

  // Change these if dedicated SMTP
  $mailer->isSMTP();
  $mailer->Host = $settings['host'];
  $mailer->SMTPAuth = true;
  $mailer->Username = $settings['username'];
  $mailer->Password = $settings['password'];
  $mailer->SMTPSecure = 'tls';
  $mailer->Port = $settings['port'];

  return $mailer;
};

// Database Container
$container['db'] = function($container){
  // Eloquent Capsule Setup
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();
  return $capsule;
};

// Initialize DB connection
$container->get('db');

// Register Twig View helper
$container['view'] = function (Container $container) {
    $settings = $container->get('settings');
    $viewPath = $settings['twig']['path'];

    $twig = new \Slim\Views\Twig($viewPath, [
        'cache' => $settings['twig']['cache_enabled'] ? $settings['twig']['cache_path'] : false
    ]);

    // TODO: Move these to middleware?

    // Give twig view access to auth controller
    $twig->getEnvironment()->addGlobal('auth',[
      'check' => $container->auth->check(),
      'user' => $container->auth->user(),
      'users' => $container->auth->users(),
      'checkAdmin' => $container->auth->checkAdmin(),
    ]);

    // Give view access to Hauliers Controller
    $twig->getEnvironment()->addGlobal('haulier', [
      'all' => $container->HauliersController->all(),
    ]);

    // Give view access to Locations Controller
    $twig->getEnvironment()->addGlobal('location', [
      'all' => $container->LocationsController->all(),
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment($container->get('environment'));
    $twig->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $twig;
};

// 404 Error Container
// @Override
$container['notFoundHandler'] = function($container){
  return function($request, $response) use ($container){
    return $container['view']->render($response->withStatus(404), '404.twig', [
    ]);
  };
};

/**
  * CONTROLLERS
*/

// Login Controller Container
$container['AuthController'] = function($container){
  return new \App\Controllers\Auth\AuthController($container);
};

// Dashboard Controller Container
$container['DashboardController'] = function($container){
  return new \App\Controllers\DashboardController($container);
};

// Password Controller Container
$container['PasswordController'] = function($container){
  return new \App\Controllers\Auth\PasswordController($container);
};

// Hauliers Controller Container
$container['HauliersController'] = function($container){
  return new \App\Controllers\HauliersController($container);
};

// Admin Tools Controller Container
$container['AdminToolsController'] = function($container){
  return new \App\Controllers\AdminToolsController($container);
};

// Feedback Controller Container
$container['FeedbackController'] = function($container){
  return new \App\Controllers\FeedbackController($container);
};

// Create Journey Controller Container
$container['JourneyController'] = function($container){
  return new \App\Controllers\JourneyController($container);
};

// Create Locations Controller Container
$container['LocationsController'] = function($container){
  return new \App\Controllers\LocationsController($container);
};

// Create Changelog Controller Container
$container['ChangelogController'] = function($container){
  return new \App\Controllers\ChangelogController($container);
};

// Validator Controller Container
$container['validator'] = function($container){
  return new App\Validation\Validator;
};

// Cross Site Request Forgery container
$container['csrf'] = function($container){
  return new \Slim\Csrf\Guard;
};

/**
  * MIDDLEWARE
*/

// Register meta info middleware
$app->add(new \App\Middleware\MetaMiddleware($container));

// Return old input
$app->add(new \App\Middleware\OldInputMiddleware($container));

// Return auth errors
$app->add(new \App\Middleware\AuthErrorsMiddleware($container));

// Return CSRF
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

// Form Validation
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

// Success Feedback Validation
$app->add(new \App\Middleware\SuccessMessageMiddleware($container));

// IP Middleware
$app->add(new RKA\Middleware\IpAddress(true, ['10.0.0.1', '10.0.0.2']));

// Route Validation
$app->add(new \App\Middleware\RouteMiddleware($container));

$app->passwordChanged = false;

// Register CSRF
$app->add($container->csrf);

// Setup custom rules
v::with('App\\Validation\\Rules\\');

?>
