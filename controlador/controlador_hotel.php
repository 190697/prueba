<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require $_SERVER['DOCUMENT_ROOT'] . '/sectur/correo/correo.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/habitacionHotel.php');

class ControladorHotel extends Conexion{
    public $model;
    public $modelHab;
    public $modelHabitacion;


    public function __construct() {
        parent::__construct();
        $this->model = new Hotel();
        $modelHab = new HabitacionHotel();
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
        $consulta=$this->_db->prepare("select * from hotel where estatus=1");
        return $this->consultas($consulta);
    }
    
    public function listarSolicitudes($idHotel) {
        $consulta=$this->_db->prepare("select * from layout where idHotel=$idHotel");
        return $this->consultas($consulta);
    }
    
    public function listarTipoHabitaciones() {
        $consulta=$this->_db->prepare("select * from habitacion where estatus=1");
        return $this->consultas($consulta);
    }
    
    public function listarHabitaciones($idHotel) {
        $consulta=$this->_db->prepare("select * from habitacion_hotel where idHotel=$idHotel and disponible=1");
        return $this->consultas($consulta);
    }
    
    public function listarGiros() {
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
    
    public function insertarHotel($model,$contrasenhia) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_hotel = $this->model->getIdHotel();
            $nombre = $this->model->getNombre();
            $correo = $this->model->getCorreo();
            $contra=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $contra= sha1($contrasenhia);
            $query = $this->_db->prepare("call usuario_hotel('$nombre','$correo','$contra')");
            if ($id_hotel > 0) {
                $query = $this->_db->prepare("call editarUsuario_hotel($id_hotel,'$nombre','$correo','$contra')");
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
            $query = $this->_db->prepare("call eliminarUsuario_hotel($id_hotel)");
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    
    public function insertarHabitacion() {
        try {
            /*
            $modelHab->setIdHabitacionHotel($_POST["txtIdHabitacion"]);
            $modelHab->hotel->setIdHotel($_POST["txtIdHotel"]);
            $modelHab->habitacion->setIdHabitacion($_POST["txtIdHotel"]);
             *              */
            $data['estado'] = 0;
            $idHabitacion = $this->modelHabitacion->getIdHabitacion();
            $nombre = $this->modelHabitacion->getNombre();
            $descripcion = $this->modelHabitacion->getDescripcion();
            $estatus= $this->modelHabitacion->getEstatus();
            $query = $this->_db->prepare("insert into habitacion values(null,'$nombre','$descripcion',$estatus)");
            if ($idHabitacion > 0) {
                $query = $this->_db->prepare("update habitacion set nombre='$nombre',descripcion='$descripcion' where idHabitacion=$idHabitacion");
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
    
    public function insertarHabitacionHotel($model) {
        try {
            /*
            $modelHab->setIdHabitacionHotel($_POST["txtIdHabitacion"]);
            $modelHab->hotel->setIdHotel($_POST["txtIdHotel"]);
            $modelHab->habitacion->setIdHabitacion($_POST["txtIdHotel"]);
             *              */
            $data['estado'] = 0;
            $this->modelHab = $model;
            $idHabitacion = $this->modelHab->getIdHabitacionHotel();
            $id_hotel = $this->modelHab->hotel->getIdHotel();
            $id_habitacion = $this->modelHab->habitacion->getIdHabitacion();
            $costo = $this->modelHab->getCosto();
            $estatus= $this->modelHab->getEstatus();
            $query = $this->_db->prepare("insert into habitacionHotel values(null,$id_hotel,$id_habitacion,$costo,$estatus)");
            if ($idHabitacion > 0) {
                $query = $this->_db->prepare("update habitacionHotel set idHabitacion=$id_habitacion,costo='$costo' where idHabitacionHotel=$idHabitacion");
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
    
    public function eliminarHabitacion() {
        try {
            $data['estado'] = 0;
            $idHabitacion = $_POST["idHabitacion"];
            $query = $this->_db->prepare("update habitacion set estatus=0 where idHabitacion=".$idHabitacion);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarHabitacionHotel($model) {
        try {
            $data['estado'] = 0;
            $this->modelHab = $model;
            $idHabitacion = $_POST["idHabitacion"];
            $query = $this->_db->prepare("update habitacionHotel set estatus=0 where idHabitacionHotel=".$idHabitacion);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function respuestaPeticion($idEstancia,$estatus) {
        try {
            $data['estado'] = 0;
            $query = $this->_db->prepare("update estancia set estatus=$estatus where idEstancia=".$idEstancia);
            if ($query->execute()) {
                $correo = new correo();
                if ($correo->enviar($idEstancia)) {
                    $data['estado'] = 1;
                }
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function buscarEstancia($idEstancia) {
        try {
            $consulta = $this->_db->prepare("select *from layout where idEstancia=".$idEstancia);
            return($this->consultas($consulta));
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function enviarCredenciales($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_hotel = $this->model->getIdHotel();
            $nombre = $this->model->getNombre();
            $correo = $this->model->getCorreo();
            $tempCorreo=$correo;
            $contra=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $tempContrasenhia=$contra;
            $contra= sha1($contra);
            $query = $this->_db->prepare("call editarUsuario_hotel($id_hotel,'$nombre','$correo','$contra')");
            if ($query->execute()) {
                $correo = new correo();
                if ($correo->enviar($tempCorreo,$tempContrasenhia)) {
                    $data['estado'] = 1;
                    $tem = null;
                }
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
