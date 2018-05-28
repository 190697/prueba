<?php
/**
 * Description of modelo_competencia
 *
 * @author Christian Muñoz
 */
class Presupuesto {

    private $idPresu;
    private $montoAlimen;
    private $montoHosped;
    private $fechaIn;
    private $fechaFin;
    private $estatus;
    
    function getIdPresu() {
        return $this->idPresu;
    }

    function getMontoAlimen() {
        return $this->montoAlimen;
    }

    function getMontoHosped() {
        return $this->montoHosped;
    }

    function getFechaIn() {
        return $this->fechaIn;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdPresu($idPresu) {
        $this->idPresu = $idPresu;
    }

    function setMontoAlimen($montoAlimen) {
        $this->montoAlimen = $montoAlimen;
    }

    function setMontoHosped($montoHosped) {
        $this->montoHosped = $montoHosped;
    }

    function setFechaIn($fechaIn) {
        $this->fechaIn = $fechaIn;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }



}
