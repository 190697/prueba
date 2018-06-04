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
            $consulta = $this->_db->prepare("select * from grupo_anfitrion where idAnfitrion=" . $idCotizacion);
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


    
    public function EstanciaGrupo($idFolio,$fechaEntrada,$hotel,$tarifa,$habitacion,$fechaSalida,$num_habitaciones,$noches,$total) {
        try {
            $data['estado'] = 0;
            $consulta = $this->_db->prepare("insert into estancia values(null,$idFolio,'$fechaEntrada','$fechaSalida',$hotel,$tarifa,$num_habitaciones,$noches,$habitacion,$total);");
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
            $idAnfitrion=$this->model->anfitrion->getIdAnfitrion();
            $antifitrion=$this->model->anfitrion->getNombre();
            $categoria=$this->model->anfitrion->getCategoria();
            $pais=$this->model->anfitrion->getPais();
            $disciplina=$this->model->anfitrion->getDisciplina();
            $grupo=$this->model->getNombre();
            $clave=$this->model->getClave();
            $folio=$this->model->getFolio();
            $numperso=$this->model->getNum_personas();
            $data['estado'] = 0;
            if ($idAnfitrion == 0) {
                $consulta = $this->_db->prepare("insert into anfitrion values(null,'$antifitrion',$categoria,$pais,$disciplina)");
                if ($consulta->execute()) {
                    $id_persona = $this->_db->lastInsertId();
                    $query = $this->_db->prepare("insert into grupo values(null,$id_persona,'$grupo','$clave','$folio',$numperso)");
                    if ($query->execute()) {
                        $query = $this->_db->prepare("insert into tarjeta values(null,$id_persona,'','',0,0)");
                        if ($query->execute()) {
                            $data['estado'] = 1;
                        }
                    }
                }
            }else{
                $consulta = $this->_db->prepare("update anfitrion set nombre='$antifitrion',categoria=$categoria,pais=$pais,disciplina=$disciplina where idAnfitrion=$idAnfitrion");
                if($consulta->execute()){
                    $consulta = $this->_db->prepare("update grupo set nombre='$grupo',clave='$clave',folio='$folio',num_personas=$numperso where idAnfitrion=$idAnfitrion");
                    if($consulta->execute())$data['estado'] = 1;
                }
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
