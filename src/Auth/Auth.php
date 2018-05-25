<?php
/**
  * Haulage Management System - Auth Manager
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Auth;

use App\Models\User;

class Auth{

  public function users(){
    return User::get();
  }

  public function user(){

    if(isset($_SESSION['user'])){
      return User::find($_SESSION['user']);
    }
  }

  public function check(){
    if(isset($_SESSION['user'])){
      return isset($_SESSION['user']);
    }
  }

  public function checkAdmin(){
    $user = User::find($_SESSION['user']);

    return $user->admin;
  }

  // Username = Username OR Email
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
