<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/usuario.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/disciplina.php');

class Grupo{
    private $idGrupo;
    public $usuario;
    private $disciplina;
    private $nombre;
    private $clave;
    private $folio;
    private $num_personas;
    
    function __construct() {
        $this->usuario = new Usuario();
        $this->disciplina = new Disciplina();
    }

    function getIdGrupo() {
        return $this->idGrupo;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdDisciplina() {
        return $this->idDisciplina;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getClave() {
        return $this->clave;
    }

    function getFolio() {
        return $this->folio;
    }

    function getNum_personas() {
        return $this->num_personas;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdDisciplina($idDisciplina) {
        $this->idDisciplina = $idDisciplina;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setFolio($folio) {
        $this->folio = $folio;
    }

    function setNum_personas($num_personas) {
        $this->num_personas = $num_personas;
    }



}
?>