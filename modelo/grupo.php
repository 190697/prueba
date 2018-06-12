<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/usuario.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/disciplina.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/persona.php');

class Grupo{
    private $idGrupo;
    public $usuario;
    public $disciplina;
    public $persona;
    private $nombre;
    private $clave;
    private $folio;
    private $num_personas;
    private $pais;
    private $categoria;
    private $subCategoria;
    
    function __construct() {
        $this->usuario = new Usuario();
        $this->disciplina = new Disciplina();
    }
    function getCategoria() {
        return $this->categoria;
    }

    function getSubCategoria() {
        return $this->subCategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setSubCategoria($subCategoria) {
        $this->subCategoria = $subCategoria;
    }

        function getDisciplina() {
        return $this->disciplina;
    }

    function getPais() {
        return $this->pais;
    }

    function setDisciplina($disciplina) {
        $this->disciplina = $disciplina;
    }

    function setPais($pais) {
        $this->pais = $pais;
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