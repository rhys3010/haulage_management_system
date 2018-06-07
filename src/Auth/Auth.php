<?php
/**
  * Haulage Management System - Auth.php
  *
  * Handle User Authentication using Eloquent's User model to query the database.
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Auth;

use App\Models\User;

class Auth{

  /**
    * A getter function to retrieve all users from the database
    * @return All users
  */
  public function users(){
    return User::get();
  }

  /**
    * A getter function to retrieve the currently logged in user
    * @return user - The Currently logged in user
  */
  public function user(){

    if(isset($_SESSION['user'])){
      return User::find($_SESSION['user']);
    }
  }

  /**
    * Check if there is a user logged in by seeing if there is a valid entry in the users table
    * @return isset - If there is a user logged in or not
  */
  public function check(){

    // If the user cannot be found unset the session
    if(!User::find($_SESSION['user'])){
      unset($_SESSION['user']);
    }

    if(isset($_SESSION['user'])){
      return isset($_SESSION['user']);
    }
  }

  /**
    * Check wether the current user is an admin by querying the admin column of the user's entry
    * @return isAdmin - If the currently logged in user is an admin
  */
  public function checkAdmin(){
    $user = User::find($_SESSION['user']);

    return $user->admin;
  }

  /**
    * Attempt to log the user in by querying the database to validate the credentials
    * @param username - The user's username OR email
    * @param password - The user's hashed password
  */
  public function attempt($username, $password){

    $user = User::where('username', $username)->orWhere('email', $username)->first();

    // Check if user exists
    if(!$user){
      return false;
    }

    // Verify that user is valid
    if(password_verify($password, $user->password)){
      $_SESSION['user'] = $user->id;
      return true;
    }

    return false;
  }

  public function logout(){
    unset($_SESSION['user']);
  }
}

?>
