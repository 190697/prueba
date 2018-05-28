<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_restaurant.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/restaurant.php');

$controlador = new ControladorRestaurant();
$model = new Restaurant();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdRestaurant($_POST["idRestaurant"]);
        $model ->setNombre($_POST["nombre"]) ;
        $model ->setCorreo($_POST["correo"]) ;
        $controlador->insertarRestaurant($model);
        break;
    
    case 2 :
        $model ->setIdRestaurant($_POST["idRestaurant"]);
        $controlador->eliminarRestaurant($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}