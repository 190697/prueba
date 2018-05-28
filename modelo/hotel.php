<?php
/**
 * Description of modelo_competencia
 *
 * @author Christian Muñoz
 */
class Hotel {

    private $idHotel;
    private $nombre;
    private $estatus;
    
    function getIdHotel() {
        return $this->idHotel;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdHotel($idHotel) {
        $this->idHotel = $idHotel;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}