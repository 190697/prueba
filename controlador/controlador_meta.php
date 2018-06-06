<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/monto.php');

class ControladorMeta extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new monto();
    }

    //-------------------Encuestas----------------------------
    public function listarMeta() {
        $datos = array();
        $consulta = $this->_db->prepare("select * from presupuesto");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }

    public function buscarMetaActual() {
        $datos = array();
        $consulta = $this->_db->prepare("select *,(select (m.monto-IFNULL(sum(total),0)) from estancia e) from monto_meta m where estatus=1;");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }

    public function MetaActual() {
        $datos = array();
        $consulta = $this->_db->prepare("select * from presupuesto;");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        //echo json_encode($datos);
        return $datos;
    }

    public function insertarMonto($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $montoAlim = $this->model->getMontoAlimento();
            $montoHosp = $this->model->getMontoHospedaje();
            // $query = $this->_db->prepare("update presupuesto set "
            // . "montoAlim=$montoAlim , montoHosped = $montoHosp where idPresu=5");
            //if ($query->execute()) {
            $query = $this->_db->prepare("insert into presupuesto values(null,$montoAlim,$montoHosp,curdate(),'2018-10-16',1)");
            if ($query->execute()) {
                $data['estado'] = 1;
            }
            //}
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
                $query = $this->_db->prepare("update giro set estatus=0 where idGiro=" . $id);
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
