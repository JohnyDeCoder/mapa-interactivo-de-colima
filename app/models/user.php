<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Nombre de la tabla

    protected $fillable = ['name']; // Campos asignables

}
