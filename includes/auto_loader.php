<?php

function class_loader($class){
    $path = "admin/includes/{$class}.php";

    if (is_file($path) && !class_exists($class)) {
        require_once($path);
    } else {
        die("<br> The file name: '" .$class. "' doesnt exists. <br> The path: '" .$path. "' is not correct.");
    }
}
spl_autoload_register('class_loader');

/* function auto_loader($class){
    require_once "includes/{$class}.php";
}
spl_autoload_register("auto_loader"); */

