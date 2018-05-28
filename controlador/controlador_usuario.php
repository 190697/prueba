<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/usuario.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tarjeta.php');

class ControladorUsuario extends Conexion {

    public $modelUsuario;
    public $modelTarjeta;

    public function __construct() {
        parent::__construct();
        $this->modelUsuario = new Usuario();
        $this->modelTarjeta= new Tarjeta();
    }

    //-------------------Clientes----------------------------
    public function indexUsuario($idUsuario) {
        if ($idUsuario > 0) {
            $consulta = $this->_db->prepare("select * from usuario where id_usuario=" . $idUsuario);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->modelUsuario->setIdUsuario($row["id_usuario"]);
                $this->modelUsuario->setNombreUsuario($row["nombreUsuario"]);
                $this->modelUsuario->setUsuario($row["usuario"]);
                $this->modelUsuario->setTipo($row["tipo"]);
                $this->modelUsuario->setEstatus($row["estatus"]);
            }
        }
        return $this->modelUsuario;
    }

    public function indexAsignacion($idUsuario) {
        if ($idUsuario > 0) {
            $consulta = $this->_db->prepare("select * from tarjeta where idTarjeta=" . $idUsuario);
            $consulta->execute();
            $result = $consulta->fetchAll();
            foreach ($result as $row) {
                $this->modelTarjeta->setIdTarjeta($row["idTarjeta"]);
                $this->modelTarjeta->setTarjeta($row["codigo"]);
                $this->modelTarjeta->setEstatus($row["estatus"]);
                $this->modelTarjeta->setNip($row["nip"]);
                $this->modelTarjeta->setMonto($row["monto"]);
            }
        }
        return $this->modelTarjeta;
    }
    
    public function listarTelefonos($idPersona) {
        try {
            if ($idPersona > 0) {
                $telefonos = array();
                $consulta = $this->_db->prepare("select *from telefono where idPersona=" . $idPersona);
                $consulta->execute();
                $result = $consulta->fetchAll();
                foreach ($result as $row) {
                    $telefonos[] = $row;
                }
                return $telefonos;
            }
        } catch (Exception $ex) {
            echo "Error" . $ex;
        }
    }

    public function listarUsuarios() {
        $datos = array();
        $consulta = $this->_db->prepare("select * from usuario");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $datos[] = $row;
        }
        return $datos;
    }

    public function listarEmpresas() {
        $empresas = array();
        $consulta = $this->_db->prepare("select idEmpresa,(select nombre from giro where idGiro=id_giro)as id_giro,nombre  from empresa where estatus=1");
        $consulta->execute();
        $result = $consulta->fetchAll();
        foreach ($result as $row) {
            $empresas[] = $row;
        }
        return $empresas;
    }

    public function insertarUsuario($model) {
        try {
            $data['estado'] = 0;
            $this->modelUsuario = $model;
            $IdUsuario = $this->modelUsuario->getIdUsuario();
            $nombre = $this->modelUsuario->getNombreUsuario();
            $usuario = $this->modelUsuario->getUsuario();
            $contrasenhia = $this->modelUsuario->getContrasenhia();
            $tipo = $this->modelUsuario->getTipo();
            $estatus = $this->modelUsuario->getEstatus();
            $query = $this->_db->prepare("insert into usuario values(null,'$nombre',$tipo,'$usuario','$contrasenhia',$estatus)");
            if ($IdUsuario > 0) {
                $query = $this->_db->prepare("update usuario set nombreUsuario='$nombre',usuario='$usuario',tipo=$tipo,estatus=$estatus,contrasenhia='$contrasenhia' where id_usuario=$IdUsuario");
            }
            if ($query->execute()) {
                $data['idUsuario'] = $this->_db->lastInsertId();
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function eliminarUsuario($model) {
        try {
            $data['estado'] = 0;
            $this->modelUsuario = $model;
            $id_usuario = $this->modelUsuario->getIdUsuario();
            $query = $this->_db->prepare("update usuario set estatus=0 where id_usuario=$id_usuario");
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function insertarTelefono($idTelefono, $idPersona, $telefono) {
        try {
            $data['estado'] = 0;
            $query = $this->_db->prepare("insert into telefono values(null,$idPersona,'$telefono')");
            if ($idTelefono > 0) {
                $query = $this->_db->prepare("update telefono set telefono='$telefono' where idtelefono=$idTelefono");
            }
            if ($query->execute()) {
                $data['idTelefono'] = $idTelefono;
                if ($idTelefono == 0) {
                    $data['idTelefono'] = $this->_db->lastInsertId();
                }
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

    public function buscarTelefono($idTelefono) {
        try {
            $data['estado'] = 0;
            $query = $this->_db->prepare("select *from telefono where idtelefono=$idTelefono");
            if ($query->execute()) {
                $result = $query->fetchAll();
                $data['estado'] = 1;
                $data['result'] = $result;
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }
    
    public function eliminarTelefono($idTelefono) {
        try {
            $data['estado'] = 0;
            $query = $this->_db->prepare("delete from telefono where idtelefono=$idTelefono");
            if ($query->execute()) {
                $data['estado'] = 1;
            }
        } catch (Exception $ex) {
            $data['estado'] = 0;
        }
        echo json_encode($data);
    }

}
