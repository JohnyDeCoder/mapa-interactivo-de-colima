<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    protected $table = 'poblacion'; // Nombre de la tabla
    public $timestamps = false; // No contiene los campos created_at ni updated_at
}
