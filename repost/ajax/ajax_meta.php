<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_meta.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/meta.php');

$controlador = new ControladorMeta();
$model = new Montometa();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setMonto($_POST["monto"]) ;
        $controlador->insertarMonto($model);
        break;
    
     case 2 :
        $model ->setIdGiro($_POST["idGiro"]) ;
        $controlador->eliminarGiro($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}