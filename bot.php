<?php
ob_start();

require_once "config/api.php";
require_once "inc/variables.php";
require_once "command/lista.php";
require_once "command/listaEspecial.php";

// Llamado recursivo de Callbacks
foreach (glob("event/callback/*.php") as $callback) {
    require_once $callback;
}

// Ejecución de Comandos
if (isset($text)) {
    $textUpdate = explode(" ", $text);
}
if (isset($textUpdate)) {
    $textUpdate = preg_match('/@/', $textUpdate[0]) ? explode('@', $textUpdate[0]) : $textUpdate;
}
if (isset($textUpdate)) {
    if (preg_match("/^\//", $textUpdate[0]) and in_array($textUpdate[0], $commands)) {
        require_once "command" . $textUpdate[0] . ".php";
    }
}
if (isset($text)) {
    if (in_array($text, $especial)) {
        $texto = strtolower(trim(preg_replace('/[[:^print:]]/', "", $text)));
        require_once "command/" . $texto . ".php";
    }
}

require_once "event/apiDocLaravel.php";
