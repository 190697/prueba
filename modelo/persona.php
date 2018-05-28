<?php
class Persona{
    private $idPersona;
    private $nombre;
    private $apellidos;
    private $edad;
    private $genero;
    private $correo;
    private $fotoPersona;
    private $fotoIdentificacion;
    private $estatus;
    
    function getIdPersona() {
        return $this->idPersona;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEdad() {
        return $this->edad;
    }

    function getGenero() {
        return $this->genero;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getFotoPersona() {
        return $this->fotoPersona;
    }

    function getFotoIdentificacion() {
        return $this->fotoIdentificacion;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setFotoPersona($fotoPersona) {
        $this->fotoPersona = $fotoPersona;
    }

    function setFotoIdentificacion($fotoIdentificacion) {
        $this->fotoIdentificacion = $fotoIdentificacion;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}
?>