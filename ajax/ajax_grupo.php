<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_grupo.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/grupo.php');

$controlador = new ControladorGrupo();
$model = new Grupo();

$accion = $_POST["accion"];

switch ($accion) {
    case 1 :
        
        break;

    case 2 :
        $idCotizacion = $_POST["idCotizacion"];
        $subfolio = $_POST["subfolio"];
        $grupo = $_POST["grupo"];
        $controlador->insertarSubFolio($idCotizacion, $subfolio, $grupo);
        break;

    case 3 :
        $idFolio = $_POST["subfolio"];
        $fechaEntrada = $_POST["fechaEntrada"];
        $hotel = $_POST["hotel"];
        $tarifa = $_POST["tarifa"];
        $habitacion = $_POST["habitacion"];
        /* $fechaSalida = $_POST["fechaSalida"]; */
        $num_habitaciones = $_POST["num_habitaciones"];
        $noches = $_POST["noches"];
        $total = $_POST["total"];
        $controlador->EstanciaGrupo($idFolio, $fechaEntrada, $hotel, $tarifa, $habitacion, /* $fechaSalida, */ $num_habitaciones, $noches, $total);
        break;

    case 4:
        $model->setIdCotizacion($_POST["idCotizacion"]);
        $controlador->eliminarCotizacion($model);
        break;
    case 5:
        $model->anfitrion->setIdAnfitrion($_POST["idCotizacion"]);
        $model->anfitrion->setNombre($_POST["txtNGrupo"]);
        $model->anfitrion->setCategoria($_POST["categoria"]);
        $model->anfitrion->setPais($_POST["pais"]);
        $model->disciplina->setIdDisciplina($_POST["pais"]);
        $model->setNombre($_POST["grupo"]);
        $model->setClave($_POST["clave"]);
        $model->setFolio($_POST["folio"]);
        $model->setNum_personas($_POST["numperso"]);
        $controlador->insertarGrupoAnfitrion($model);
        break;

    case 6:
        $id_hotel = $_POST["id_hotel"];
        $controlador->listarHabitacionHotel($id_hotel);
        break;
    case 7:
        $id_Integra = $_POST["id_integrant"];
        $controlador->mostrarIntegrante($id_Integra);
        break;
    default :
        echo 'No se encontró la opción';
        break;
}
