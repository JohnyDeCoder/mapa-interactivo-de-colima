<?php

// Carga las dependencias de Composer
require_once 'vendor/autoload.php';

// Crea un enrutador
$router = new \Bramus\Router\Router();

// Definir una ruta que coincida con la ruta raíz ('/')
$router->get('/', function () {
	require __DIR__ . '/web/';
});

// Ejecuta el enrutador
$router->run();
