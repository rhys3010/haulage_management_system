<?php

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

// Auth Container
$container['auth'] = function($container){
  return new \App\Auth\Auth;
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


    // Give view access to auth controller
    $twig->getEnvironment()->addGlobal('auth',[
      'check' => $container->auth->check(),
      'user' => $container->auth->user(),
      'users' => $container->auth->users()
    ]);

    // Give view access to Hauliers Controller
    $twig->getEnvironment()->addGlobal('haulier', [
      'all' => $container->HauliersController->all(),
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment($container->get('environment'));
    $twig->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $twig;
};


// Login Container
$container['AuthController'] = function($container){
  return new \App\Controllers\Auth\AuthController($container);
};

// Dashboard Container
$container['DashboardController'] = function($container){
  return new \App\Controllers\DashboardController($container);
};

// Password Container
$container['PasswordController'] = function($container){
  return new \App\Controllers\Auth\PasswordController($container);
};

// Hauliers Container
$container['HauliersController'] = function($container){
  return new \App\Controllers\HauliersController($container);
};

// Validator Container
$container['validator'] = function($container){
  return new App\Validation\Validator;
};

// Cross Site Request Forgery container
$container['csrf'] = function($container){
  return new \Slim\Csrf\Guard;
};


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

$app->passwordChanged = false;

// Register CSRF
$app->add($container->csrf);

// Setup custom rules
v::with('App\\Validation\\Rules\\');

?>
