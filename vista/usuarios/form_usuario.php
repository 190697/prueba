<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_usuario.php');
$idUsuario=0;
if(isset($_POST["id"])){
    $idUsuario=$_POST["id"];
}
$editar=0;
if(isset($_POST["editar"])){
    $editar=$_POST["editar"];
}
$controladorUsuario = new ControladorUsuario();
$model = $controladorUsuario->indexUsuario($idUsuario);
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div class="modal fade" id="modalUsuario" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar cliente</font></h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="txtEditarUsuario" name="txtEditarUsuario" value="<?=$editar?>">
                    <input type="hidden" id="txtIdUsuario" name="txtIdUsuario" value="<?= $model->getIdUsuario() ?>">
                    <div class="form-group">
                        <b>Nombre:</b>
                        <input class="form-control" type="text" id="txtNombre" name="txtNombre" value="<?= $model->getNombreUsuario() ?>" placeholder="Nombre de persona*">
                    </div>
                     <div class="form-group">
                        <b>Usuario:</b>
                        <input class="form-control" type="text" id="txtNombreUsuario" name="txtNombreUsuario" value="<?= $model->getUsuario() ?>" placeholder="Usuario*">
                    </div>
                     <div class="form-group">
                        <b>Contraseña:</b>
                        <input class="form-control" type="text" id="txtContrasenhia" name="txtContrasenhia" value="<?= $model->getContrasenhia() ?>" placeholder="Contraseña*">
                    </div>
                    <div class="form-group">
                        <b>Estatus:</b><br>
                        <?php
                            $activo="";
                            $inactivo="checked";
                            $empleado="selected='selected'";
                            $admin="";
                            if($model->getEstatus()==1){
                                $activo="checked";
                                $inactivo="";                                
                            }
                            if($model->getTipo()==9){
                                $empleado="";
                                $admin="selected='selected'";
                            }
                        ?>
                        <input type="radio" id="txtEstatus" name="gender" value="1" <?=$activo?>> <span style="color: #28B463;">Activo <i class='fa fa-check' aria-hidden=true></i></span>&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="txtEstatus" name="gender" value="0" <?=$inactivo?>> <span style="color: #FF0000;">Inactivo <i class='fa fa-minus' aria-hidden=true></i></span>
                    </div>
                    <div class="form-group">
                        <b>Tipo usuario:</b>
                        <select class="form-control" id="dropdownEstatus" name="dropdownEstatus">
                            <option>Selecciona su estatus...</option>
                            <option value="1" <?=$empleado?>>Empleado</option>
                            <option value="9" <?=$admin?>>Administrador</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarUsuario()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalUsuario").modal();
</script>