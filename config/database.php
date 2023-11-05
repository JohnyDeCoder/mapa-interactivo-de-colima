<?php

// Carga las dependencias de Composer (Doctrine, Dotenv, etc.)
require_once __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configuración de la conexión a la base de datos
return [
    'driver' => $_ENV['DB_DRIVER'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_NAME'],
    'host' => $_ENV['DB_HOST'],
];
