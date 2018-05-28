<?php
/**
 * Description of modelo_competencia
 *
 * @author Christian Muñoz
 */
class NivelTarjeta {

    private $idNivel;
    private $nivel;
    private $montoNivel;
    private $estatus;
    
    function getIdNivel() {
        return $this->idNivel;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getMontoNivel() {
        return $this->montoNivel;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdNivel($idNivel) {
        $this->idNivel = $idNivel;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setMontoNivel($montoNivel) {
        $this->montoNivel = $montoNivel;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


    

}