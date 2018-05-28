<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_restaurant.php');
$idRestaurant=0;
if(isset($_POST["id"])){
    $idRestaurant=$_POST["id"];
}
$editar=0;
if(isset($_POST["editar"])){
    $editar=$_POST["editar"];
}
$controladorRestaurant = new ControladorRestaurant();
$model = $controladorRestaurant->indexRestaurant($idRestaurant);
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div class="modal fade" id="modalRestaurantform" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar restaurant</font></h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="txtEditarRestaurant" name="txtEditarRestaurant" value="<?=$editar?>">
                    <input type="hidden" id="txtIdRestaurant" name="txtIdRestaurant" value="<?= $model->getIdRestaurant() ?>">
                    <div class="form-group text-center">
                        <b>Nombre:</b>
                        <input class="form-control" type="text" id="txtNombreRestaurant" name="txtNombreRestaurant" value="<?= $model->getNombre() ?>" placeholder="Nombre del restaurant">
                    </div>
                    <div class="form-group text-center">
                        <b>Correo:</b>
                        <input class="form-control" type="text" id="txtCorreoRestaurant" name="txtCorreoRestaurant" value="<?= $model->getCorreo() ?>" placeholder="Correo de restaurant">
                        <div id="xmail" class="hide"><h5 class="text-danger">Ingresa un email valido</h5></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarRestaurant()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalRestaurantform").modal();
</script>