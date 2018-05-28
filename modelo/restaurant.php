<?php
/**
 * Description of modelo_competencia
 *
 * @author Christian Muñoz
 */
class Restaurant {

    private $idRestaurant;
    private $nombre;
    private $estatus;
    
    function getIdRestaurant() {
        return $this->idRestaurant;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdRestaurant($idRestaurant) {
        $this->idRestaurant = $idRestaurant;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}