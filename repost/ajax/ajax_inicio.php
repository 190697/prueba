<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_index.php');
//require_once($_SERVER['DOCUMENT_ROOT'] . '/crm!/modelo/giro.php');

$controlador = new ControladorIndex();
//$model = new Giro();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $controlador->graficaDiaria();
        break;
    
     case 2 :
        $controlador->graficaSemanal();
        break;
    
    case 3 :
        $controlador->graficaMensual();
        break;
    
    case 4:
        $controlador->iniciarSesion();
        break;
    
    case 5:
        $controlador->cerrarSesion();
        break;
    
    case 6:
        $controlador->consultarSaldo();
        break;

    default :
        echo 'No se encontró la opción';
        break;
}