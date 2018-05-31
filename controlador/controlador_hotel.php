<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tipoHabitacion.php');

class ControladorHotel extends Conexion{
    public $model;
    public $modelHab;


    public function __construct() {
        parent::__construct();
        $this->model = new Hotel();
        $modelHab = new TipoHabitacion();
    }

    //-------------------Encuestas----------------------------
    public function indexHotel($idHotel) {
        if ($idHotel>0) {
            $consulta = $this->_db->prepare("select * from hotel where idhotel=" . $idHotel);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->model->setIdHotel($row["idHotel"]);
                $this->model->setNombre($row["nombre"]);
                $this->model->setCorreo($row["correo"]);
                $this->model->setEstatus($row["estatus"]);
            }
        }
        return $this->model;
    }
    
    public function listarHoteles() {
        $empresas=array();
        $consulta=$this->_db->prepare("select * from hotel where estatus=1");
        return $this->consultas($consulta);
    }
    
    public function listarHabitaciones($idHotel) {
        $empresas=array();
        $consulta=$this->_db->prepare("select * from tipoHabitacion where idHotel=$idHotel and estatus=1");
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
        if(!$result){
            return null;
        }else{
            foreach ($result as $row){
                $datos[]=$row;
            }
        }
        return $datos;
    }
    
    public function insertarHotel($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_hotel = $this->model->getIdHotel();
            $nombre = $this->model->getNombre();
            $correo = $this->model->getCorreo();
            $query = $this->_db->prepare("insert into hotel values(null,'$nombre','$correo',1)");
            if ($id_hotel > 0) {
                $query = $this->_db->prepare("update hotel set nombre='$nombre',correo='$correo' where idHotel=$id_hotel");
            }
            if ($query->execute()) {
                $data['estado'] = 1;
            }
            $data['idHotel'] = $id_hotel;
            if($id_hotel == 0){
                $data['idHotel'] = $this->_db->lastInsertId();
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarHotel($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_hotel = $this->model->getIdHotel();
            $query = $this->_db->prepare("update hotel set estatus=0 where idHotel=".$id_hotel);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function insertarHabitacion($model) {
        try {
            $data['estado'] = 0;
            $this->modelHab = $model;
            $idHabitacion = $this->modelHab->getIdTipohab();
            $id_hotel = $this->modelHab->hotel->getIdHotel();
            $nombre = $this->modelHab->getNombTipo();
            $costo = $this->modelHab->getCosto();
            $estatus= $this->modelHab->getEstatus();
            $query = $this->_db->prepare("insert into tipoHabitacion values(null,$id_hotel,'$nombre',$costo,$estatus)");
            if ($idHabitacion > 0) {
                $query = $this->_db->prepare("update tipoHabitacion set nombTipo='$nombre',costo='$correo' where idTipoHab=$idHabitacion");
            }
            if ($query->execute()) {
                $data['estado'] = 1;
            }
            $data['idHabitacion'] = $idHabitacion;
            if($idHabitacion == 0){
                $data['idHabitacion'] = $this->_db->lastInsertId();
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarHabitacion($model) {
        try {
            $data['estado'] = 0;
            $this->modelHab = $model;
            $idHabitacion = $_POST["idHabitacion"];
            $query = $this->_db->prepare("update tipoHabitacion set estatus=0 where idTipoHab=".$idHabitacion);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
