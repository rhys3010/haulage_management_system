<?php
/**
  * Haulage Management System - The Journey Model
  *
  * @author Rhys Evans
  * @version 31/05/2018
  * 2018 (C) Rhys Evans
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
  * Journey Class - An Eloquent class to represent the 'journeys' relation in the database
*/
class Journey extends Model{

  // The SQL table this model refers to
  protected $table = 'journeys';

  protected $fillable = [
    'source',
    'destination',
    'haulier',
    'datetime',
  ];
}
?>
