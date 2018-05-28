<?php
/**
 * Description of modelo_competencia
 *
 * @author Christian Muñoz
 */
class Disciplina {

    private $idDisciplina;
    private $nombre;
    private $descripcion;
    private $estatus;
    
    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function getIdDisciplina() {
        return $this->idDisciplina;
    }

    function setIdDisciplina($idDisciplina) {
        $this->idDisciplina = $idDisciplina;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getEstatus() {
        return $this->estatus;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }


}