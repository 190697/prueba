<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_venta.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/usuario.php');

$controlador = new ControladorVenta();
$model = new Usuario();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $tarjeta=$_POST["idTarjeta"];
        $controlador->buscarPersona($tarjeta);
        break;
    
    case 2:
        $idTarjeta=$_POST["idTarjeta"];
        $servicio=$_POST["servicio"];
        $detalle=$_POST["detalle"];
        $total=$_POST["total"];
        $nip=$_POST["nip"];
        $controlador->insertarVenta($idTarjeta,$servicio,$detalle,$total,$nip);
        break;
    
    case 3 :
        $controlador->exportarExcel();
        break;

    default :
        echo 'No se encontró la opción';
        break;
}