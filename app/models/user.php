<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Nombre de la tabla
    public $timestamps = false; // No contiene los campos created_at ni updated_at
    protected $fillable = ['name']; // Campos asignables
}
