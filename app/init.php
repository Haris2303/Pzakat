<?php

// autoload class on folder core
spl_autoload_register(function($class) {
    // get class name, if use namespace
    $class = explode('\\', $class);
    $class = end($class);
    
    require_once __DIR__ . '/core/' . $class . '.php';
});

// autoload class on folder vendor
spl_autoload_register(function($class) {
    // get class name, if use namespace
    $class = explode('\\', $class);
    $class = end($class);

    require_once __DIR__ . $class . '.php';
});

require_once 'config/config.php';