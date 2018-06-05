<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/habitacion.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/habitacionHotel.php');

$controlador = new ControladorHotel();
$model = new Hotel();
$modelHab = new HabitacionHotel();
$modelHabitacion =new Habitacion();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdHotel($_POST["idHotel"]);
        $model ->setNombre($_POST["nombre"]) ;
        $model ->setCorreo($_POST["correo"]) ;
        $contrasenhia= $_POST["contrasenhia"];
        $controlador->insertarHotel($model,$contrasenhia);
        break;
    
    case 2 :
        $model ->setIdHotel($_POST["idHotel"]);
        $controlador->eliminarHotel($model);
        break;
    
    case 3:
        $modelHab->setIdHabitacionHotel($_POST["txtIdHabitacion"]);
        $modelHab->hotel->setIdHotel($_POST["txtIdHotel"]);
        $modelHab->habitacion->setIdHabitacion($_POST["txtIdHab"]);
        $modelHab->setCosto($_POST["txtCostoHab"]);
        $modelHab->setEstatus(1);
        $controlador->insertarHabitacionHotel($modelHab);
        break;
    
    case 4 :
        $modelHab->setIdHabitacionHotel($_POST["idHabitacion"]);
        $controlador->eliminarHabitacionHotel($model);
        break;
    
    case 5:
        $modelHabitacion->setIdHabitacion($_POST["txtIdHabitacion"]);
        $modelHabitacion->setNombre($_POST["txtHabitacion"]);
        $modelHabitacion->setDescripcion($_POST["txtDetalleHab"]);
        $modelHabitacion->setEstatus(1);
        $controlador->modelHabitacion= $modelHabitacion;
        $controlador->insertarHabitacion();
        break;
    
    case 6 :
        $modelHabitacion->setIdHabitacion($_POST["idHabitacion"]);
        $controlador->modelHabitacion= $modelHabitacion;
        $controlador->eliminarHabitacion();
        break;

    default :
        echo 'No se encontró la opción';
        break;
}