<?php
spl_autoload_register(function($class){
    $arquivo = str_replace('\\', '/', $class) . '.php';
    if (file_exists($arquivo)) {
        include $arquivo;
    }
});