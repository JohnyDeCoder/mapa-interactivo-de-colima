<?php

// Carga las dependencias de Composer (Doctrine, Dotenv, etc.)
require_once 'vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

// Configuración de la conexión a la base de datos
return [
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => $_ENV['DB_CHARSET'],
];
