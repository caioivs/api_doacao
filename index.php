<?php
include "generic/Autoload.php";

// Carrega o Composer (necessário para a biblioteca JWT)
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

use generic\Controller;

$controller = new Controller();
$parametro = (isset($_GET["param"]) && !empty($_GET["param"])) ? $_GET["param"] : "home";
$controller->verificarChamadas($parametro);
?>