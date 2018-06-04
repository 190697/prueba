<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/habitacion.php');
class HabitacionHotel{
    private $idHabitacionHotel;
    public $hotel;
    public $habitacion;
    private $costo;
    private $estatus;
    
    function __construct() {
        $this->hotel = new Hotel();
        $this->habitacion = new Habitacion();
    }

    function getIdHabitacionHotel() {
        return $this->idHabitacionHotel;
    }

    function getHotel() {
        return $this->hotel;
    }

    function getHabitacion() {
        return $this->habitacion;
    }

    function getCosto() {
        return $this->costo;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdHabitacionHotel($idHabitacionHotel) {
        $this->idHabitacionHotel = $idHabitacionHotel;
    }

    function setHotel($hotel) {
        $this->hotel = $hotel;
    }

    function setHabitacion($habitacion) {
        $this->habitacion = $habitacion;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}
?>