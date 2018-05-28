<?php
class TipoUsuario{
    private $idTipoUsuario;
    private $nombreTipo;
    
    function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    function getNombreTipo() {
        return $this->nombreTipo;
    }

    function setIdTipoUsuario($idTipoUsuario) {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    function setNombreTipo($nombreTipo) {
        $this->nombreTipo = $nombreTipo;
    }

}
?>