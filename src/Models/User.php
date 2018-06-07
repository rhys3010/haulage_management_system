<?php
/**
  * Haulage Management System - User.php
  *
  * Eloquent model for the Users table in the database
  *
  * PHP Version 7
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @license http://www.php.net/license/3_01.txt  PHP License 3.01
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

  // The SQL table this model refers to
  protected $table = 'users';

  protected $fillable = [
    'username',
    'password',
    'name',
    'email',
    'admin',
  ];

  public function setPassword($password){
    $this->update([
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
  }
}


?>
