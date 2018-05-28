<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/presupuesto.php');

class ControladorMeta extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Presupuesto();
    }

    //-------------------Encuestas----------------------------
    public function listarMeta(){
        $datos = array();
        $consulta = $this->_db->prepare("select * from monto_meta");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }
    
    public function buscarMetaActual(){
        $datos = array();
        $consulta = $this->_db->prepare("select *,(select (m.monto-IFNULL(sum(total),0)) from estancia e) from monto_meta m where estatus=1;");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }
    
    public function insertarMonto($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $monto=$this->model->getMonto();
            $query = $this->_db->prepare("update monto_meta set estatus=0 where idMonto_meta");
            if ($query->execute()) {
                $query = $this->_db->prepare("insert into monto_meta values(null,$monto,now(),1)");
                if ($query->execute()) {
                    $data['estado'] = 1;
                }
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarGiro($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id = $this->model->getIdGiro();
            if ($id) {
                $query = $this->_db->prepare("update giro set estatus=0 where idGiro=".$id);
            }
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
