<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tarjeta.php');

class ControladorVenta extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Tarjeta();
    }

    //-------------------Ventas----------------------------
    public function consultas($consulta){
        $datos = array();
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }
    
    public function listarMovimientosTarjeta() {
        $consulta = $this->_db->prepare("select * from movimiento_usuario");
        return $this->consultas($consulta);
    }
    
    function buscarPersona($idTarjeta){
        $tarjeta = $idTarjeta;
        $statement = $this->_db->prepare("select * from anfitrion_tarjeta where codigo='" . $tarjeta .  "' and estatus=1");
        $statement->execute();
        $result = $statement->fetchAll();
        if (!$result) {
            $data['estado'] = 1;
        } else {
            $data['estado'] = 2;
            $data['result']=$result;
        }
        echo json_encode($data);
    }
    
    function historial($idUsuario){
        $statement = $this->_db->prepare("select * from movimiento_usuario where idAnfitrion=$idUsuario");
        return $this->consultas($statement);
    }
    
    function insertarVenta($idTarjeta,$servicio,$detalle,$total,$nip){
        $data['estado'] = 0;
        $nip=sha1($nip);
        $statement = $this->_db->prepare("select * from tarjeta where idTarjeta=$idTarjeta and nip='$nip' and estatus=1");
        $statement->execute();
        $result = $statement->fetchAll();
        if ($result) {
            $statement = $this->_db->prepare("insert into movimientoTarjeta values(null,$idTarjeta,'$servicio',now())");
            if ($statement->execute()) {
                $idMovimiento=$this->_db->lastInsertId();
                $statement = $this->_db->prepare("insert into detalleMovimiento values(null,$idMovimiento,'$servicio','$detalle',$total)");
                if ($statement->execute()) {
                    $data['estado'] = 1;
                }
            }
        } 
        echo json_encode($data);
    }
    
    public function exportarExcel() {
        header('Content-Encoding: UTF-8');
        header("Content-type: application/vnd.ms-excel; name='excel'; charset=UTF-8");
        header("Content-Disposition: filename=ficheroExcel.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "\xEF\xBB\xBF"; //UTF-8 BOM
        echo $_POST['datos_a_enviar'];
    }
    
}
