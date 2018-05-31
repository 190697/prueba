<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tipoHabitacion.php');

$controlador = new ControladorHotel();
$model = new Hotel();
$modelHab = new TipoHabitacion();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdHotel($_POST["idHotel"]);
        $model ->setNombre($_POST["nombre"]) ;
        $model ->setCorreo($_POST["correo"]) ;
        $controlador->insertarHotel($model);
        break;
    
    case 2 :
        $model ->setIdHotel($_POST["idHotel"]);
        $controlador->eliminarHotel($model);
        break;
    
    case 3:
        $modelHab->setIdTipohab($_POST["txtIdHabitacion"]);
        $modelHab->setHotel($_POST["txtIdHabitacion"]);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}