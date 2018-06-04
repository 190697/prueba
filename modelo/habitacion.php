<?php
class Habitacion{
    private $idHabitacion;
    private $nombre;
    private $descripcion;
    private $estatus;

    function getIdHabitacion() {
        return $this->idHabitacion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdHabitacion($idHabitacion) {
        $this->idHabitacion = $idHabitacion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }



}
?>