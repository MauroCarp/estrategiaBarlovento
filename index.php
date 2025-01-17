<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/estrategia.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/estrategia.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
