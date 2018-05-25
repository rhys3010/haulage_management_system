<?php
/**
  * Haulage Management System - User Generation Script for use by sysadmins
  *
  * @author Rhys Evans
  * @version 22/05/2018
  * 2018 (C) Rhys Evans
*/

require_once __DIR__ . '/../vendor/autoload.php';

// Load .env file for sensitive configs
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../config/');
$dotenv->load();

// Setup database information from .env
$dbservername = getenv("DB_HOST");
$dbname = getenv("DB_DATABASE");
$dbusername = getenv("DB_USERNAME");
$dbpassword = getenv("DB_PASSWORD");

// Connec to mysql database
$connection = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

if($connection->connect_error){
  die("Connection to MySql failed: " . $connection->connect_error);
}

// Get user information from command line
echo("Enter User Infromation Below to Register new User: \n");
$username = readline('Username: ');
$password = readline('Password: ');
$name = readline('Name: ');
$email = readline('Email: ');
$admin = readline('Admin? (0/1): ');

// Hash Password
$password = password_hash($password, PASSWORD_DEFAULT);

// Create User Record
$sql = "INSERT INTO users (username, password, name, email, admin) VALUES ('".$username."', '".$password."', '".$name."', '".$email."', '".$admin."')";


// Perform SQL creation query
if($connection->query($sql) === TRUE){
  echo "New User Registered Successfully\n";
}else{
  echo "Error: " . $sql . "\n" . $connection->error;
}

$connection->close();
?>
