<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_disciplina.php');
$idDisciplina=0;
if(isset($_POST["id"])){
    $idDisciplina=$_POST["id"];
}
$editar=0;
if(isset($_POST["editar"])){
    $editar=$_POST["editar"];
}
$controladorDisciplina = new ControladorDisciplina();
$model = $controladorDisciplina->indexDisciplina($idDisciplina);
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div class="modal fade" id="modalDisciplinaform" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar Disciplina</font></h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="txtEditarDisciplina" name="txtEditarDisciplina" value="<?=$editar?>">
                    <input type="hidden" id="txtIdDisciplina" name="txtIdDisciplina" value="<?= $model->getIdDisciplina() ?>">
                    <div class="form-group text-center">
                        <b>Nombre:</b>
                        <input class="form-control" type="text" id="txtNombreDisciplina" name="txtNombreDisciplina" value="<?= $model->getNombre() ?>" placeholder="Nombre de la disciplina">
                    </div>
                    <div class="form-group text-center">
                        <b>Descripción:</b>
                        <input class="form-control" type="text" id="txtDescripcionDisciplina" name="txtDescripcionDisciplina" value="<?= $model->getDescripcion() ?>" placeholder="Descripción de la disciplina">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarDisciplina()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalDisciplinaform").modal();
</script>