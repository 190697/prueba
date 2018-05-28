<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tarjeta.php');

class ControladorTarjeta extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Tarjeta();
    }

    //-------------------Clientes----------------------------
    
    public function consultas($consulta){
        $datos = array();
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }
    public function indexUsuario($idUsuario) {
        if ($idUsuario > 0) {
            $consulta = $this->_db->prepare("select * from usuario where id_usuario=" . $idUsuario);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->model->setIdUsuario($row["id_usuario"]);
                $this->model->setNombreUsuario($row["nombreUsuario"]);
                $this->model->setUsuario($row["usuario"]);
                $this->model->setTipo($row["tipo"]);
                $this->model->setEstatus($row["estatus"]);
            }
        }
        return $this->model;
    }

    public function listarAnfitrionTarjeta() {
        $consulta = $this->_db->prepare("select * from anfitrion_tarjeta");
        return $this->consultas($consulta);
    }

    public function asignarTarjeta($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $IdTarjeta = $this->model->getIdTarjeta();
            $tarjeta = $this->model->getTarjeta();
            $nip = sha1($this->model->getNip());
            $monto = $this->model->getMonto();
            $estatus = $this->model->getEstatus();
            $query = $this->_db->prepare("select (case when count(idTarjeta)=0 then 0 else 1 end) as cantidad from tarjeta where codigo='$tarjeta' and idAnfitrion!=$IdTarjeta;");
            $query->execute();
            $result = $query->fetchAll();
            foreach ($result as $row) {
                $existe = $row[0];
            }
            if($existe==0){
                $query = $this->_db->prepare("update tarjeta set codigo='$tarjeta',nip='$nip',monto=$monto,estatus=$estatus where idTarjeta=$IdTarjeta");
                if ($query->execute()) {
                    $data['estado'] = 1;
                }
            }else{
                $data['estado'] = 3;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function estatusTarjeta($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $IdTarjeta = $this->model->getIdTarjeta();
            $estatus = $this->model->getEstatus();
            $query = $this->_db->prepare("update tarjeta set estatus=$estatus where idTarjeta=$IdTarjeta");
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
