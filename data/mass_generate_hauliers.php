<?php

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

for($i = 0; $i < 100; $i++){
  // Get user information from command line
  $short_name = 'HC' . $i;
  $name = 'Hauling Company #' . $i;

  // Create User Record
  $sql = "INSERT INTO hauliers (short_name, name) VALUES ('".$short_name."', '".$name."')";


  // Perform SQL creation query
  if($connection->query($sql) === TRUE){
    echo "New Haulier Registered Successfully\n";
  }else{
    echo "Error: " . $sql . "\n" . $connection->error;
  }
}

$connection->close();
?>
