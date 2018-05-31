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
        $modelHab->hotel->setIdHotel($_POST["txtIdHotel"]);
        $modelHab->setNombTipo($_POST["txtNombreHab"]);
        $modelHab->setCosto($_POST["txtCostoHab"]);
        $modelHab->setEstatus(1);
        $controlador->insertarHabitacion($modelHab);
        break;
    
    case 4 :
        $modelHab->setIdTipohab($_POST["idHabitacion"]);
        $controlador->eliminarHabitacion($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}