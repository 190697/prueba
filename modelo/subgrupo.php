<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/grupo.php');

class Subgrupo{
    private $idSubgrupo;
    public $grupo;
    private $subFolio;
    private $fecha;
    
    function __construct() {
        $this->grupo = new Grupo();
    }
    
    function getIdSubgrupo() {
        return $this->idSubgrupo;
    }

    function getGrupo() {
        return $this->grupo;
    }

    function getSubFolio() {
        return $this->subFolio;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdSubgrupo($idSubgrupo) {
        $this->idSubgrupo = $idSubgrupo;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    function setSubFolio($subFolio) {
        $this->subFolio = $subFolio;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }


    
}
?>