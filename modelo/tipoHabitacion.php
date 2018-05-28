<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/hotel.php');
class TipoHabitacion{
    private $idTipohab;
    private $hotel;
    private $nombTipo;
    private $costo;
    
    function __construct() {
        $this->hotel = new Hotel();
    }

    
    function getIdTipohab() {
        return $this->idTipohab;
    }

    function getHotel() {
        return $this->hotel;
    }

    function getNombTipo() {
        return $this->nombTipo;
    }

    function getCosto() {
        return $this->costo;
    }

    function setIdTipohab($idTipohab) {
        $this->idTipohab = $idTipohab;
    }

    function setHotel($hotel) {
        $this->hotel = $hotel;
    }

    function setNombTipo($nombTipo) {
        $this->nombTipo = $nombTipo;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }



}
?>