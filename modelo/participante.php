<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/persona.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/grupo.php');

class Participante{
    private $idParticipante;
    private $persona;
    private $grupo;
    private $esAnfitrion; 
    
    function __construct() {
        $this->persona = new Persona();
        $this->grupo = new Grupo();
    }
    
    function getIdParticipante() {
        return $this->idParticipante;
    }

    function getPersona() {
        return $this->persona;
    }

    function getGrupo() {
        return $this->grupo;
    }

    function getEsAnfitrion() {
        return $this->esAnfitrion;
    }

    function setIdParticipante($idParticipante) {
        $this->idParticipante = $idParticipante;
    }

    function setPersona($persona) {
        $this->persona = $persona;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    function setEsAnfitrion($esAnfitrion) {
        $this->esAnfitrion = $esAnfitrion;
    }


    
}
?>