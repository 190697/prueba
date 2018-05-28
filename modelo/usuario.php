<?php
class Usuario{
    private $idUsuario;
    private $tipo;
    private $usuario;
    private $contrasenhia;
    private $estatus;
    
    function getEstatus() {
        return $this->estatus;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }
       
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getContrasenhia() {
        return $this->contrasenhia;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setContrasenhia($contrasenhia) {
        $this->contrasenhia = $contrasenhia;
    }



}
?>