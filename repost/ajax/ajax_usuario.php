<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/usuario.php');

$controlador = new ControladorUsuario();
$model = new Usuario();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdUsuario($_POST["idUsuario"]);
        $model ->setNombreUsuario($_POST["nombre"]) ;
        $model ->setUsuario($_POST["usuario"]);
        $model ->setContrasenhia($_POST["contrasenhia"]) ;
        $model ->setTipo($_POST["tipo"]) ;
        $model ->setEstatus($_POST["estatus"]) ;
        $controlador->insertarUsuario($model);
        break;
    
    case 2 :
        $model ->setIdUsuario($_POST["idUsuario"]);
        $controlador->eliminarUsuario($model);
        break;
    
    case 3 :
        $idPersona=$_POST["idPersona"];
        $telefono=$_POST["telefono"];
        $idTelefono=$_POST["idTelefono"];
        $controlador->insertarTelefono($idTelefono, $idPersona, $telefono);
        break;
    
    case 4 :
        $idTelefono =$_POST["idTelefono"];
        $controlador->buscarTelefono($idTelefono);
        break;
    
    case 5 :
        $idTelefono =$_POST["idTelefono"];
        $controlador->eliminarTelefono($idTelefono);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}