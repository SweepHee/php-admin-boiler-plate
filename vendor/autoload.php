<?php

spl_autoload_register(function ($path) {
$path = str_replace('\\','/',$path);
$paths = explode('/', $path);
if (preg_match('/models/', strtolower($paths[1]))) {
    $className = 'models';
} else if (preg_match('/controllers/',strtolower($paths[1]))) {
    $className = 'controllers';
} else {
    $className = $paths[1];
}

$loadpath =  $paths[0].'/'.$className.'/'.$paths[2].'.php';

if (!file_exists($loadpath)) {
    echo " --- autoload : file not found. ($loadpath) ";
    exit();
}

require_once $loadpath;

});