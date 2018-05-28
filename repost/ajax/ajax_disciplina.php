<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_disciplina.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/disciplina.php');

$controlador = new ControladorDisciplina();
$model = new Disciplina();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        $model ->setIdDisciplina($_POST["idDisciplina"]);
        $model ->setNombre($_POST["nombre"]) ;
        $model ->setDescripcion($_POST["descripcion"]) ;
        $controlador->insertarDisciplina($model);
        break;
    
    case 2 :
        $model ->setIdDisciplina($_POST["idDisciplina"]);
        $controlador->eliminarDisciplina($model);
        break;

    default :
        echo 'No se encontró la opción';
        break;
}