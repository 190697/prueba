<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of monto
 *
 * @author Metaconsultec
 */
class monto {

    //put your code here
    private $idPresupuento;
    private $montoAlimento;
    private $montoHospedaje;
    private $fechaInicio;
    private $feechaFin;

    function __construct() {
        
    }

    function getIdPresupuento() {
        return $this->idPresupuento;
    }

    function getMontoAlimento() {
        return $this->montoAlimento;
    }

    function getMontoHospedaje() {
        return $this->montoHospedaje;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFeechaFin() {
        return $this->feechaFin;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdPresupuento($idPresupuento) {
        $this->idPresupuento = $idPresupuento;
    }

    function setMontoAlimento($montoAlimento) {
        $this->montoAlimento = $montoAlimento;
    }

    function setMontoHospedaje($montoHospedaje) {
        $this->montoHospedaje = $montoHospedaje;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFeechaFin($feechaFin) {
        $this->feechaFin = $feechaFin;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

}
