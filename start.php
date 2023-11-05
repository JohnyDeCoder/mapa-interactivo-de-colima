<?php

require 'vendor/autoload.php'; // Cargamos las dependencias de Composer
require 'config.php'; // Cargamos la configuración de Eloquent ORM

use Models\Database; // Importamos la clase Database

new Database(); // Inicializamos Illuminate Database Connection
