<?php 
// DB Params
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_PORT', $_ENV['DB_PORT']);

define('DB_NAME', $_ENV['DB_NAME']);
define('DB_ROOT_USER', $_ENV['DB_ROOT_USER']);
define('DB_ROOT_PWD', $_ENV['DB_ROOT_PWD']);

define('DB_USER', $_ENV['DB_USER']);
define('DB_PWD', $_ENV['DB_PWD']);

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root
define('URLROOT', $_ENV['URLROOT']);

// Site Name
define('SITENAME', $_ENV['APPNAME']);