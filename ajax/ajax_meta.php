<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_meta.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/monto.php');

$controlador = new ControladorMeta();
$model = new monto();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model->setMontoAlimento($_POST["montoAlim"]);
        $model->setMontoHospedaje($_POST["montoHosp"]);
        $controlador->insertarMonto($model);
        break;

    case 2 :
        $model->setIdGiro($_POST["idGiro"]);
        $controlador->eliminarGiro($model);
        break;
    default :
        echo 'No se encontró la opción';
        break;
}