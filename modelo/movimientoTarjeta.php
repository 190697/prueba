<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/restaurant.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/tarjeta.php');

class Tarjeta{
    private $idMovimiento;
    private $restaurant;
    private $tarjeta;
    private $ticket;
    private $fecha;
    
    function __construct() {
        $this->tarjeta = new Tarjeta();
        $this->restaurant = new Restaurant();
    }
    
    function getIdMovimiento() {
        return $this->idMovimiento;
    }

    function getRestaurant() {
        return $this->restaurant;
    }

    function getTarjeta() {
        return $this->tarjeta;
    }

    function getTicket() {
        return $this->ticket;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdMovimiento($idMovimiento) {
        $this->idMovimiento = $idMovimiento;
    }

    function setRestaurant($restaurant) {
        $this->restaurant = $restaurant;
    }

    function setTarjeta($tarjeta) {
        $this->tarjeta = $tarjeta;
    }

    function setTicket($ticket) {
        $this->ticket = $ticket;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }


    
}
?>