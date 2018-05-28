<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
$idHotel=0;
if(isset($_POST["id"])){
    $idHotel=$_POST["id"];
}
$editar=0;
if(isset($_POST["editar"])){
    $editar=$_POST["editar"];
}
$controladorHotel = new ControladorHotel();
$model = $controladorHotel->indexHotel($idHotel);
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div class="modal fade" id="modalHotelform" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar hotel</font></h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="txtEditarHotel" name="txtEditarHotel" value="<?=$editar?>">
                    <input type="hidden" id="txtIdHotel" name="txtIdHotel" value="<?= $model->getIdHotel() ?>">
                    <div class="form-group text-center">
                        <b>Nombre:</b>
                        <input class="form-control" type="text" id="txtNombreHotel" name="txtNombreHotel" value="<?= $model->getNombre() ?>" placeholder="Nombre del hotel">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarHotel()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalHotelform").modal();
</script>