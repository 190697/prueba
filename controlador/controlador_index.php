<?php

header("Content-Type: text/html;charset=utf-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/conexion/conexion.php');

class ControladorIndex extends Conexion {

    public $model;

    public function __construct() {
        parent::__construct();
    }

    //-------------------Inicio----------------------------
    public function layout() {
        $consulta = $this->_db->prepare("select * from layout");
        return ($this->consultas($consulta));
    }
    
    public function listarGrupo_Anfitrion() {
        $consulta = $this->_db->prepare("select * from grupo_anfitrion");
        return ($this->consultas($consulta));
    }
    
    public function indexDisciplinas() {
        $consulta = $this->_db->prepare("select * from disciplina");
        return ($this->consultas($consulta));
    }
    
    public function indexHoteles() {
        $consulta = $this->_db->prepare("select * from hotel");
        return ($this->consultas($consulta));
    }
    
    public function indexSubfolios($idGrupo) {
        $consulta = $this->_db->prepare("select * from subgrupo where idGrupo=$idGrupo");
        return ($this->consultas($consulta));
    }
    
    public function indexHospedaje($idGrupo) {
        $consulta = $this->_db->prepare("select * from hospedaje where idGrupo=$idGrupo");
        return ($this->consultas($consulta));
    }

    public function listarCotizacionesSeguimiento() {
        $consulta = $this->_db->prepare("select * from cotizacion_cliente c inner join detalle_cotizacion dc on c.idCotizacion=dc.idCotizacion where estatus=2 order by fecha asc");
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

    public function graficaDiaria() {
        $consulta = $this->_db->prepare('select (case when respuesta=1 then "Correo" when respuesta=2 then "Whatsapp" when respuesta=3 then "Llamada" else "Visita" end)as prueba,count(idCotizacion) as numero from cotizacion where respuesta>0 
                                            and idCotizacion in(select idCotizacion from detalle_cotizacion where fecha_respuesta=CURDATE()) group by respuesta;');
        $this->consultasAjax($consulta);
    }
    
    public function graficaSemanal() {
        $consulta = $this->_db->prepare('select (case when respuesta=1 then "Correo" when respuesta=2 then "Whatsapp" when respuesta=3 then "Llamada" else "Visita" end)as prueba,count(idCotizacion) as numero from cotizacion where respuesta>0 
                                            and idCotizacion in(select idCotizacion from detalle_cotizacion where WEEKOFYEAR(fecha_respuesta)>=WEEKOFYEAR(CURDATE())) group by respuesta;');
        $this->consultasAjax($consulta);
    }
    
    public function graficaMensual() {
        $consulta = $this->_db->prepare('select (case when respuesta=1 then "Correo" when respuesta=2 then "Whatsapp" when respuesta=3 then "Llamada" else "Visita" end)as prueba,count(idCotizacion) as numero from cotizacion where respuesta>0 
                                            and idCotizacion in(select idCotizacion from detalle_cotizacion where MONTH(fecha_respuesta)>=MONTH(CURDATE())) group by respuesta;');
        $this->consultasAjax($consulta);
    }
    
    public function iniciarSesion() {
        $usuario = addslashes(htmlspecialchars($_POST["usrname"]));
        $contra = addslashes(htmlspecialchars($_POST["psw"]));
        $contrasena = sha1($contra);
        $statement = $this->_db->prepare("select * from login where usuario='" . $usuario . "' and contrasenhia='" . $contrasena . "' and estatus=1");
        $statement->execute();
        $result = $statement->fetchAll();
        if (!$result) {
            echo 1;
        } else {
            foreach ($result as $row):
                $id_usuario = $row["idUsuario"];
                $tipo = $row["tipo"];
                $nombre = $row["usuario"];
            endforeach;
            session_start();
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['tipo'] = $tipo;
            $_SESSION['nombre'] = $nombre;
            echo 2;
        }
    }
    
    public function consultarSaldo() {
        $tarjeta = addslashes(htmlspecialchars($_POST["txtTarjeta"]));
        $nip = addslashes(htmlspecialchars($_POST["txtNip"]));
        $nip = sha1($nip);
        $statement = $this->_db->prepare("select * from anfitrion_tarjeta where codigo='" . $tarjeta . "' and nip='" . $nip . "' and estatus=1");
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
    
    public function cerrarSesion() {
        session_start();
        if (session_destroy()) {
            echo 1;
        } else {
            echo 2;
        }
    }
    
    public function consultasAjax($consulta) {
        try {
            $data['estado'] = 0;
            $consulta->execute();
            $result = $consulta->fetchAll();
            if ($result) {
                $data['estado'] = 1;
                $data['result'] = $result;
            }
        } catch (Exception $exc) {
            $data['estado'] = 0;
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
