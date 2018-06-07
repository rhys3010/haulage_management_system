<?php
/**
  * Haulage Management System - Haulier.php
  *
  * Eloquent model for the Hauliers table in the database
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

class Haulier extends Model{

  // The SQL table this model refers to
  protected $table = 'hauliers';

  protected $fillable = [
    'short_name',
    'name',
  ];

}


?>
