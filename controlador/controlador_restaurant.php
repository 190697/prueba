<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/restaurant.php');

class ControladorRestaurant extends Conexion{
    public $model;
    public function __construct() {
        parent::__construct();
        $this->model = new Restaurant();
    }

    //-------------------Encuestas----------------------------
    public function indexRestaurant($idRestaurant) {
        if ($idRestaurant>0) {
            $consulta = $this->_db->prepare("select * from restaurant where idRestaurant=" . $idRestaurant);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->model->setIdRestaurant($row["idRestaurant"]);
                $this->model->setNombre($row["nombre"]);
                $this->model->setCorreo($row["correo"]);
                $this->model->setEstatus($row["estatus"]);
            }
        }
        return $this->model;
    }
    
    public function listarRestaurantes() {
        $empresas=array();
        $consulta=$this->_db->prepare("select * from restaurant where estatus=1");
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
    
    public function insertarRestaurant($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_restaurant = $this->model->getIdRestaurant();
            $nombre = $this->model->getNombre();
            $correo = $this->model->getCorreo();
            $query = $this->_db->prepare("insert into restaurant values(null,'$nombre','$correo',1)");
            if ($id_restaurant > 0) {
                $query = $this->_db->prepare("update restaurant set nombre='$nombre',correo='$correo' where idRestaurant=$id_restaurant");
            }
            if ($query->execute()) {
                $data['estado'] = 1;
            }
            $data['idRestaurant'] = $id_restaurant;
            if($id_restaurant == 0){
                $data['idRestaurant'] = $this->_db->lastInsertId();
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarRestaurant($model) {
        try {
            $data['estado'] = 0;
            $this->model = $model;
            $id_hotel = $this->model->getIdRestaurant();
            $query = $this->_db->prepare("update restaurant set estatus=0 where idRestaurant=".$id_hotel);
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
