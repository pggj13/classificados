<?php

session_start();
require './config.php';
spl_autoload_register(function($class) {

    if (strpos($class, 'Controller') > -1) {
        if (file_exists('controllers/' . $class . '.php')) {
            require_once 'controllers/' . $class . '.php';
        }
    } elseif (file_exists('models/' . $class . '.php')) {
        require_once 'models/' . $class . '.php';
    } elseif (file_exists('cores/' . $class . '.php')) {
        require_once 'cores/' . $class . '.php';
    }
});
$cores = new Core();
$cores->run();
?>
    
