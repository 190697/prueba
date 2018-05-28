<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_usuario.php');
$idUsuario=0;
if(isset($_POST["id"])){
    $idUsuario=$_POST["id"];
}
$controladorUsuario = new ControladorUsuario();
$model = $controladorUsuario->indexAsignacion($idUsuario);
$activa="selected";
$inactiva="";
if($model->getEstatus()==0){
    $inactiva="selected";
    $activa="";
}
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div class="modal fade" id="modalAsignacion" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Asignar tarjeta usuario</font></h4>
            </div>
            <div class="modal-body text-center">
                <form>
                    <input type="hidden" id="txtEditarUsuario" name="txtEditarUsuario" value="<?=$editar?>">
                    <input type="hidden" id="txtIdTarjeta" name="txtIdTarjeta" value="<?=$idUsuario?>">
                    <div class="form-group">
                        <b>Tarjeta*</b>
                        <input class="form-control" type="text" id="txtTarjeta" name="txtTarjeta" value="<?=$model->getTarjeta();?>" placeholder="Lea la tarjeta" maxlength="10">
                    </div>
                     <div class="form-group">
                        <b>NIP*</b>
                        <input class="form-control" type="number" id="txtNip" name="txtNip" value="<?=$model->getNip();?>" placeholder="4 digitos" max="9999" maxlength="4">
                    </div>
                     <div class="form-group">
                        <b>Monto*</b>
                        <?php
                        if($model->getMonto()>0){?>
                        <input class="form-control" type="text" id="txtMonto2" name="txtMonto2" value="$<?= number_format($model->getMonto(),2);?>" disabled>
                        <input class="form-control" type="hidden" id="txtMonto" name="txtMonto" value="<?=$model->getMonto()?>">
                        <?php
                        }else{?>
                            <input class="form-control" type="number" id="txtMonto" name="txtMonto" placeholder="0.00">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <b>Estatus*</b>
                        <select class="form-control" id="dropdownEstatus" name="dropdownEstatus">
                            <option>Selecciona su estatus...</option>
                            <option value="1" <?=$activa;?>>Activada</option>
                            <option value="0" <?=$inactiva;?>>Desactivada</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarTarjeta()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalAsignacion").modal();
    $("#txtTarjeta").focus();
    $("#txtTarjeta").focus(function (){
        swal({
            title: "Tarjeta!",
            text: "Debe de escanear alguna tajeta.",
            type: "info",
            timer: 2000,
            showConfirmButton: false,
        });
    });
</script>