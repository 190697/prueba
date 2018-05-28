<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/subgrupo.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tipoHabitacion.php');

class Estancia{
    private $idEstancia;
    private $hotel;
    private $tipoHabitacion;
    private $subgrupo;
    private $num_habitaciones;
    private $num_noches;
    private $fechaEntrada;
    private $fechaSalida;
    private $total;
    
    function __construct() {
        $this->hotel = new Hotel();
        $this->tipoHabitacion = new TipoHabitacion();
        $this->subgrupo = new Subgrupo();
    }
    
    function getIdEstancia() {
        return $this->idEstancia;
    }

    function getHotel() {
        return $this->hotel;
    }

    function getTipoHabitacion() {
        return $this->tipoHabitacion;
    }

    function getSubgrupo() {
        return $this->subgrupo;
    }

    function getNum_habitaciones() {
        return $this->num_habitaciones;
    }

    function getNum_noches() {
        return $this->num_noches;
    }

    function getFechaEntrada() {
        return $this->fechaEntrada;
    }

    function getFechaSalida() {
        return $this->fechaSalida;
    }

    function getTotal() {
        return $this->total;
    }

    function setIdEstancia($idEstancia) {
        $this->idEstancia = $idEstancia;
    }

    function setHotel($hotel) {
        $this->hotel = $hotel;
    }

    function setTipoHabitacion($tipoHabitacion) {
        $this->tipoHabitacion = $tipoHabitacion;
    }

    function setSubgrupo($subgrupo) {
        $this->subgrupo = $subgrupo;
    }

    function setNum_habitaciones($num_habitaciones) {
        $this->num_habitaciones = $num_habitaciones;
    }

    function setNum_noches($num_noches) {
        $this->num_noches = $num_noches;
    }

    function setFechaEntrada($fechaEntrada) {
        $this->fechaEntrada = $fechaEntrada;
    }

    function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;
    }

    function setTotal($total) {
        $this->total = $total;
    }

        
}
?>