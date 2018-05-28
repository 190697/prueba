<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/participante.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/nivelTarjeta.php');

class Tarjeta{
    private $idTarjeta;
    private $participante;
    private $nivel;
    private $codigo;
    private $monto;
    private $nip;
    private $estatus;
    
    function __construct() {
        $this->participante = new Participante();
        $this->nivel = new NivelTarjeta();
    }
    
    function getIdTarjeta() {
        return $this->idTarjeta;
    }

    function getParticipante() {
        return $this->participante;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getMonto() {
        return $this->monto;
    }

    function getNip() {
        return $this->nip;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdTarjeta($idTarjeta) {
        $this->idTarjeta = $idTarjeta;
    }

    function setParticipante($participante) {
        $this->participante = $participante;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setNip($nip) {
        $this->nip = $nip;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }



}
?>