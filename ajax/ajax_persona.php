<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_persona.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/persona.php');

$controlador = new ControladorPersona();
$model = new Persona();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $controlador->insertPerGrup();
        break;
    case 2 :
        $idFolio = $_POST["subfolio"];
        $fechaEntrada = $_POST["fechaEntrada"];
        $hotel = $_POST["hotel"];
        $tarifa = $_POST["tarifa"];
        $habitacion = $_POST["habitacion"];
        $fechaSalida = $_POST["fechaSalida"];
        $num_habitaciones = $_POST["num_habitaciones"];
        $noches = $_POST["noches"];
        $total= $_POST["total"];
        $controlador->EstanciaGrupo($idFolio,$fechaEntrada,$hotel,$tarifa,$habitacion,$fechaSalida,$num_habitaciones,$noches,$total);
        break;
    
}

