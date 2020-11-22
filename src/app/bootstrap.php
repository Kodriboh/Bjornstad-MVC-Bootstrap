<?php 

// Load Config
require_once '../app/config/config.php';

// Autoload Core Libraries
spl_autoload_register(function($className) {
    require_once 'libs/' . $className . '.php';
});