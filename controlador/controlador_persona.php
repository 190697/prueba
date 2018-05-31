<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/persona.php');

class ControladorPersona extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Persona();
    }

    //-------------------Cotizaciones----------------------------

    public function insertarPersona($model) {
        try {
            $this->model = $model;
            $nombre = $this->model->getNombre();
            $apellido = $this->model->getApellidos();
            $correo = $this->model->getCorreo();
            $data['estado'] = 0;
            $consulta = $this->_db->prepare("insert into persona values(null,null,'$nombre','$apellido',null,null,null,'$correo',1);");
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
        $nombreG = addslashes(htmlspecialchars($_POST["txtNombreG"]));
        $clave = addslashes(htmlspecialchars($_POST["txtClave"]));
        $folio = addslashes(htmlspecialchars($_POST["txtFolio"]));
        $contra= sha1($folio);
        $numP = addslashes(htmlspecialchars($_POST["txtNumP"]));
        $idDisciplina = addslashes(htmlspecialchars($_POST["dropDisGrupo"]));
        try {
            $statement = $this->_db->prepare("call InsertAnf_Grupo(?,?,?,?,?,?,?,?,?)");
            $statement->bindParam(1, $nombreP);
            $statement->bindParam(2, $apellido);
            $statement->bindParam(3, $correo);
            $statement->bindParam(4, $idDisciplina);
            $statement->bindParam(5, $nombreG);
            $statement->bindParam(6, $clave);
            $statement->bindParam(7, $folio);
            $statement->bindParam(8, $contra);
            $statement->bindParam(9, $numP);
            if ($statement->execute()) {
                $data['estado'] = 1;
            }
            echo json_encode($data);
        } catch (Exception $ex) {
            print_r($ex);
        }
    }

}
