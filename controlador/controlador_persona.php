<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/persona.php');
require $_SERVER['DOCUMENT_ROOT'] . '/sectur/correo/correo.php';

class ControladorPersona extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Persona();
    }

    //-------------------Cotizaciones----------------------------

    public function actualizarPersona($model) {
        try {
            $this->model = $model;
            $idPerson = $this->model->getIdPersona();
            $nombre = $this->model->getNombre();
            $apellido = $this->model->getApellidos();
            $correo = $this->model->getCorreo();
            $data['estado'] = 0;
            $consulta = $this->_db->prepare("update persona set nombre='$nombre',"
                    . "apellidos ='$apellido',correo='$correo' where idPersona='$idPerson';");
            if ($consulta->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function insertPerGrup() {
        $data['estado'] = 0;
        $nombreP = addslashes(htmlspecialchars($_POST["txtNombreP"]));
        $apellido = addslashes(htmlspecialchars($_POST["txtApP"]));
        $correo = addslashes(htmlspecialchars($_POST["txtCorreP"]));
        $temCorr = $correo;
        $nombreG = addslashes(htmlspecialchars($_POST["txtNombreG"]));
        $clave = addslashes(htmlspecialchars($_POST["txtClave"]));
        $folio = addslashes(htmlspecialchars($_POST["txtFolio"]));
        $pais = addslashes(htmlspecialchars($_POST["dropPais"]));
        $categoria = addslashes(htmlspecialchars($_POST["dropCate"]));
        $subcategoria = addslashes(htmlspecialchars($_POST["dropTipo"]));
        $tem = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        $contra = sha1($tem);
        $numP = addslashes(htmlspecialchars($_POST["txtNumP"]));
        $idDisciplina = addslashes(htmlspecialchars($_POST["dropDisGrupo"]));
        if ($nombreP == null || $apellido == null || $correo == null ||
                $nombreG == null || $clave == null || $folio == null ||
                $numP == null || $idDisciplina == null || $categoria == "cat") {
            $data['estado'] = 0;
        } else {
            if ($subcategoria == "op") {
                $subcategoria = "0";
            }
            try {
                $statement = $this->_db->prepare("call InsertAnf_Grupo(?,?,?,?,?,?,?,?,?,?,?,?)");
                $statement->bindParam(1, $nombreP);
                $statement->bindParam(2, $apellido);
                $statement->bindParam(3, $correo);
                $statement->bindParam(4, $idDisciplina);
                $statement->bindParam(5, $nombreG);
                $statement->bindParam(6, $clave);
                $statement->bindParam(7, $folio);
                $statement->bindParam(8, $contra);
                $statement->bindParam(9, $numP);
                $statement->bindParam(10, $pais);
                $statement->bindParam(11, $categoria);
                $statement->bindParam(12, $subcategoria);
                if ($statement->execute()) {
                    $correo = new correo();
                    if ($correo->enviar($temCorr,$tem)) {
                        $data['estado'] = 1;
                        $tem = null;
                    }
                }
            } catch (Exception $ex) {
                print_r($ex);
            }
        }
        echo json_encode($data);
    }

}

//hnxdkjgfxds
