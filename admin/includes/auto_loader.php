<?php

function class_loader($class){
    $path = "includes/{$class}.php";

    if (is_file($path) && !class_exists($class)) {
        require($path);
    } else {
        die("<br> The file name: '" .$class. "' doesnt exists. <br> The path: '" .$path. "' is not correct.");
    }
} 

spl_autoload_register('class_loader');




