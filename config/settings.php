<?php
/**
  * Haulage Management System - settings.php
  *
  * The project's configuration file, this is where all the preferences and config info is loaded from a .env file.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */
$settings = [];

// Load .env file for sensitive configs
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Slim settings
// Set this to false in production
$settings['displayErrorDetails'] = true;
$settings['determineRouteBeforeAppMiddleware'] = true;

// Project Settings
$settings['version'] = getenv("APP_VERSION");

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// View settings
$settings['twig'] = [
    'path' => $settings['root'] . '/resources/views',
    'cache_enabled' => false,
    'cache_path' =>  $settings['temp'] . '/twig-cache'
];

// Database settings
$settings['db']['driver']     = getenv("DB_DRIVER");
$settings['db']['host']       = getenv("DB_HOST");
$settings['db']['database']   = getenv("DB_DATABASE");
$settings['db']['username']   = getenv("DB_USERNAME");
$settings['db']['password']   = getenv("DB_PASSWORD");
$settings['db']['charset']    = getenv("DB_CHARSET");
$settings['db']['collation']  = getenv("DB_COLLATION");

// Logger Settings
$settings['logger']['name'] = 'haulage_management_system';
$settings['logger']['path'] = __DIR__ . '/../logs/haulage_management_system.log';
$settings['logger']['level'] = \Monolog\Logger::INFO;

// Mail Settings
$settings['mail']['host'] = getenv("MAIL_HOST");
$settings['mail']['port'] = (int)(getenv("MAIL_PORT"));
$settings['mail']['username'] = getenv("MAIL_USERNAME");
$settings['mail']['password'] = getenv("MAIL_PASSWORD");
$settings['mail']['recipient'] = getenv("MAIL_RECIPIENT");

return $settings;

?>
