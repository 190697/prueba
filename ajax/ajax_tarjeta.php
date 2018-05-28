<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_tarjeta.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tarjeta.php');

$controlador = new ControladorTarjeta();
$model = new Tarjeta();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdTarjeta($_POST["idTajeta"]);
        $model ->setTarjeta($_POST["tarjeta"]) ;
        $model ->setMonto($_POST["monto"]);
        $model ->setNip($_POST["nip"]) ;
        $model ->setEstatus($_POST["estatus"]) ;
        $controlador->asignarTarjeta($model);
        break;
    
    case 2 :
        $model ->setIdTarjeta($_POST["idTajeta"]);
        $model ->setEstatus($_POST["estatus"]) ;
        $controlador->estatusTarjeta($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}