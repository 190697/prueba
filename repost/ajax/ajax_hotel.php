<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');

$controlador = new ControladorHotel();
$model = new Hotel();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdHotel($_POST["idHotel"]);
        $model ->setNombre($_POST["nombre"]) ;
        $controlador->insertarHotel($model);
        break;
    
    case 2 :
        $model ->setIdHotel($_POST["idHotel"]);
        $controlador->eliminarHotel($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}