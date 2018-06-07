# Haulage Management System

## Synopsis
The Haulage Management System is a computerised system to record various aspects of registered
Hauliers’ journeys and present it to the user in a logical and intuitive way.

## Data
* For this system to function a database must be setup using the schema in `/data/schema.sql`
* The 'locations' table can be populated by data for any country or region, however there is a UK postal code dataset in `data/uk_locations.sql`.

## Development
* In the project's root directory run `php composer.phar install` this will create a 'vendor' directory with all the needed php dependencies
* In the project's root directory rename the file '.env.sample' to '.env' and fill in the required information.
* Run the command `php -S localhost:8080` from the /public directory to start the application

## Deployment
* Ensure the .htaccess files within the root directory and the /public directory are correct for your configuration
* In `config/settings.php` ensure that 'displayErrorDetails' is set to false
* Ensure that the project's read/write perms are recursively set to allow the web server to read and write (for the logs).

## Built With
* Slim - Web framework used
