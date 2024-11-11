<?php
session_start();
require_once __DIR__ . '../config/config.php';
require_once __DIR__ . '../config/database.php';
spl_autoload_register(function($class) {
    $paths=[
        __DIR__ . '/controllers/' . $class ,
        __DIR__ . '/models/' . $class ,


    ];
    foreach($paths as $path){
        if(file_exists($path)){
            require_once $path;
            return;
        }
    }
});
?>