<?php
/**
  * Haulage Management System - The User Model
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
  * User Class - An Eloquent class to represent the 'users' relation in the database
*/
class User extends Model{

  // The SQL table this model refers to
  protected $table = 'users';

  protected $fillable = [
    'username',
    'password',
    'name',
    'email',
  ];



}


?>
