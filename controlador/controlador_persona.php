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
            $this->model=$model;
            $nombre=$this->model->getNombre();
            $apellido=$this->model->getApellidos();
            $correo=$this->model->getCorreo();
            $data['estado'] = 0;
                $consulta = $this->_db->prepare("insert into persona values(null,null,'$nombre','$apellido',null,null,null,'$correo',1);");
                if($consulta->execute()){
                    $data['estado'] = 1;
                }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
