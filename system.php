<?php

/*
 * @autor Ivette Mateo Washbrum, Katherine Gallegos Carrillo, Yessenia Vargas Matute, Carlos Luis Rodriguez Nieto
 * @date 01-may-2017
 * @time 22:27:45
 * @link http://luis-rodriguez-ec.herokuapp.com/site/index
 */

$system_path = "../../";
$clases = $system_path . "clases/";

if (realpath($clases) !== FALSE) {
    $clases = realpath($clases) . '/';
}

// ensure there's a trailing slash
$clases = rtrim($clases, '/') . '/';

// Is the system path correct?
if (!is_dir($clases)) {
    exit("Tu carpeta de sistema no esta correcta. Por favor abrir el archivo y verifique este: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}
define('BASECLASS', str_replace("\\", "/", $clases));

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Tu carpeta de sistema no esta correcta. Por favor abrir el archivo y verifique este: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}
define('BASEPATH', str_replace("\\", "/", $system_path));