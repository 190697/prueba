<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/disciplina.php');

class ControladorDisciplina extends Conexion{
    public $model;
    public function __construct() {
        parent::__construct();
        $this->model = new Disciplina();
    }

    //-------------------Encuestas----------------------------
    public function indexDisciplina($idDisciplina) {
        if ($idDisciplina>0) {
            $consulta = $this->_db->prepare("select * from disciplina where idDisciplina=" . $idDisciplina);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->model->setIdDisciplina($row["idDisciplina"]);
                $this->model->setNombre($row["nombre"]);
                $this->model->setDescripcion($row["descripcion"]);
                $this->model->setEstatus($row["estatus"]);
            }
        }
        return $this->model;
    }
    
    public function listarDisciplinas() {
        $empresas=array();
        $consulta=$this->_db->prepare("select * from disciplina where estatus=1");
        return $this->consultas($consulta);
    }
    
    public function listarGiros() {
        $datos=array();
        $consulta=$this->_db->prepare("select * from giro where estatus=1");
        return $this->consultas($consulta);
    }
    
    public function consultas($consulta){
        $consulta->execute();
        $result=$consulta->fetchAll();
        foreach ($result as $row){
            $datos[]=$row;
        }
        return $datos;
    }
    
    public function insertarDisciplina($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_disciplina = $this->model->getIdDisciplina();
            $nombre = $this->model->getNombre();
            $descripcion = $this->model->getDescripcion();
            $query = $this->_db->prepare("insert into disciplina values(null,'$nombre','$descripcion',1)");
            if ($id_disciplina > 0) {
                $query = $this->_db->prepare("update disciplina set nombre='$nombre',descripcion='$descripcion' where idDisciplina=$id_disciplina");
            }
            if ($query->execute()) {
                $data['estado'] = 1;
            }
            $data['idDisciplina'] = $id_disciplina;
            if($id_disciplina == 0){
                $data['idDisciplina'] = $this->_db->lastInsertId();
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarDisciplina($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_disciplina = $this->model->getIdDisciplina();
            $query = $this->_db->prepare("update disciplina set estatus=0 where idDisciplina=".$id_disciplina);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
