<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/sectur/modelo/participante.php');

class Anfitrion{
    private $idAnfitrion;
    private $participante;
    private $fecha;
    
    function __construct() {
        $this->participante = new Participante();
    }
    

}
?>