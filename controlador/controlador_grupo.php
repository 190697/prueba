<?php
header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/grupo.php');

class ControladorGrupo extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Grupo();
    }
    //-------------------Cotizaciones----------------------------
    public function indexCotizacion($idCotizacion) {
        if ($idCotizacion > 0) {
            $consulta = $this->_db->prepare("select * from grupo_anfitrion where idGrupo=" . $idCotizacion);
            return ($this->consultas($consulta));
        }
        return null;
    }
    
    public function integrantesGrupo($idCotizacion) {
        if ($idCotizacion > 0) {
            $consulta = $this->_db->prepare("select per.idPersona, per.genero, per.nombre,per.apellidos
                ,per.fotoPersona,per.correo,per.fotoIdentificacion, p.esAnfitrion
from persona per inner join participante p on per.idPersona = p.idPersona 
inner join grupo g on g.idGrupo = p.idGrupo where g.idGrupo =" . $idCotizacion);
            return ($this->consultas($consulta));
        }
        return null;
    }
    
    public function grupoAnfitrion($idCotizacion) {
        if ($idCotizacion > 0) {
            $consulta = $this->_db->prepare("select * from grupo_anfitrion where idAnfitrion=" . $idCotizacion);
            return ($this->consultas($consulta));
        }
        return null;
    }
    
    public function indexDisciplinas() {
        $consulta = $this->_db->prepare("select * from disciplina");
        return ($this->consultas($consulta));
    }
    
    public function consultas($consulta) {
        try {
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $cotizaciones[] = $row;
            }
            if (!isset($cotizaciones))
                return null;
            return $cotizaciones;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function listarHoteles(){
        $consulta = $this->_db->prepare("select * from hotel where estatus=1");
        return ($this->consultas($consulta));
    }
    
    public function listarHabitacionHotel($idHotel){
        $statement = $this->_db->prepare("select * from habitacion_hotel where idHotel=$idHotel and disponible=1");
        $statement->execute();
        $result = $statement->fetchAll();
        $data['result'] = $result;
        echo json_encode($data);
    }
    
    public function mostrarIntegrante($idIntegrant){
        $statement = $this->_db->prepare("select * from persona where idPersona=$idIntegrant");
        $statement->execute();
        $result = $statement->fetchAll();
        $data['result'] = $result;
        echo json_encode($data);
    }
    
    public function insertarSubFolio($idCotizacion,$subfolio,$grupo) {
        try {
            $data['estado'] = 0;
            if ($idCotizacion == 0) {
                $consulta = $this->_db->prepare("insert into subgrupo values(null,$grupo,'$subfolio',now())");
                if ($consulta->execute()) {
                    $data['estado'] = 1;
                    $data['subfolio'] = $this->_db->lastInsertId();
                }
            }else{
                $consulta = $this->_db->prepare("update cotizacion set servicio='$servicio',detalle_servicio='$detalle_servicio',duracion='$duracion',num_personas=$num_personas where idCotizacion=$id");
                if($idCotizacion->execute()){
                    $data['estado'] = 1;
                }
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }


    
    public function EstanciaGrupo($idFolio,$fechaEntrada,$hotel,$tarifa,$habitacion,/*$fechaSalida,*/$num_habitaciones,$noches,$total) {
        try {
            $data['estado'] = 0;
            $consulta = $this->_db->prepare("insert into estancia values(null,$hotel,$idFolio,$habitacion,'$fechaEntrada','',$num_habitaciones,$noches,$total,1);");
            if ($consulta->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $exc) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function insertarGrupoAnfitrion($model) {
        try {
            $this->model=$model;
            $idGrupo = $this->model->getIdGrupo();
            $disciplina=$this->model->getIdDisciplina();
            $grupo=$this->model->getNombre();
            $clave=$this->model->getClave();
            $folio=$this->model->getFolio();
            $numperso=$this->model->getNum_personas();
            $pais = $this->model->getPais();
            $data['estado'] = 0;
                $consulta = $this->_db->prepare("update grupo set nombre='$grupo',clave='$clave',"
                        . "pais=$pais,folio='$folio',num_personas=$numperso where idGrupo=$idGrupo");
                if($consulta->execute()){
                    if($consulta->execute())$data['estado'] = 1;
              }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
