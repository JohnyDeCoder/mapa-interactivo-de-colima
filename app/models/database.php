<?php

namespace Models;

use Illuminate\Database\Capsule\Manager as Capsule; // Importar Capsule

class Database
{
    function __construct() // Constructor
    {
        $config = include __DIR__ . '/../../config.php'; // Cargar la configuración de la base de datos
        $capsule = new Capsule; // Crear una nueva instancia de Capsule
        // Agregar la configuración de la base de datos
        $capsule->addConnection($config);

        // Inicializar Eloquent ORM
        $capsule->bootEloquent();
    }
}

