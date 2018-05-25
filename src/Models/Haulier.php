<?php
/**
  * Haulage Management System - The Haulier Model
  *
  * @author Rhys Evans
  * @version 21/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
  * Haulier Class - An Eloquent class to represent the 'hauliers' relation in the database
*/
class Haulier extends Model{

  // The SQL table this model refers to
  protected $table = 'hauliers';

  protected $fillable = [
    'name',
  ];

}


?>
