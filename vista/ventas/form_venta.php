<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_usuario.php');
require_once('../grupo/paises.php');
$idUsuario=0;
$usuarios=array("Prensa","Invitados especiales","Grupos artísticos","Comité organizador del festival","Técnicos","Personal de apoyo");
$disciplinas=array("Academia","Artes visuales","Artes Plásticas","Performance","Artes visuales","Música","Danza","Circo","Teatro","Sin definir");
if(isset($_POST["id"])){
    $idtarjeta=$_POST["id"];
}
/*$controladorUsuario = new ControladorUsuario();
$model = $controladorUsuario->indexUsuario($idUsuario);*/
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/venta.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalAsignacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar venta</font></h4>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" id="txtEditarUsuario" name="txtEditarUsuario" value="<?=$editar?>">
                <input type="hidden" id="txtIdTarjeta" name="txtIdTarjeta" value="0">
                <input type="hidden" id="txtDisponible" name="txtDisponible" value="0">
                <div class="form-group">
                    <b>Tarjeta*</b>
                    <input class="form-control" type="text" id="txtTarjeta" value="" placeholder="Lea la tarjeta" onkeypress="validar(event)" maxlength="10">
                    <label id="error4" class="error" style="color: red;">Debe escanear su tarjeta</label>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div align="center">
                            <h4>Información de anfitrión</h4>
                            <hr>
                            <div class="form-group text-center">
                                <b>Monto disponible</b>
                                <input class="form-control" type="number" id="txtMonto" name="txtMonto" value="" placeholder="0.00" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>Nombre de anfitrión</b>
                                <input class="form-control" type="txtNombre" id="txtNombre" placeholder="Nombre de anfitrión" disabled/>
                            </div>
                            <!---->
                            <div class="form-group">
                                <b>Categoria de usuario</b>
                                <select class="form-control" id="dropCatUsuario" disabled>
                                    <option>Selecciona la categoria..</option>
                                    <?php
                                    $i=0;
                                    foreach ($usuarios as $row) {?>
                                        <option value='<?=$i?>' ><?=$row?></option>

                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <!---->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>País o región</b>
                                <select class="form-control" id="dropPaisUsuario" disabled>
                                    <option>Selecciona pais/region..</option>
                                    <?php
                                    $i=0;
                                    foreach ($paises as $row) {?>
                                        <option value='<?=$i?>' ><?=$row?></option>

                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <b>Disciplina</b>
                                <select class="form-control" id="dropDisUsuario" disabled>
                                    <option>Selecciona la disciplina..</option>
                                    <?php
                                    $i=0;
                                    foreach ($disciplinas as $row) {?>
                                        <option value='<?=$i?>' ><?=$row?></option>

                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-12">
                        <form id="fromVenta" style="display: none;">
                            <div align="center">
                                <h4>Información de la venta</h4>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <b>Servicio</b>
                                    <input class="form-control" type="txtServicio" id="txtServicio" placeholder="Servicio"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <b>Detalle del servicio</b>
                                    <input class="form-control" type="txtDetalleServicio" id="txtDetalleServicio" placeholder="Detalle"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <b>Total</b>
                                    <input class="form-control" type="number" id="txtTotal" placeholder="Total"/>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarVenta()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalAsignacion").modal();
    $("#error4").hide();
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
    function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==13){
                buscarUsuario();
                $("#txtNip").focus();
            }else{
                $("#error1").hide(500);
                $("#error2").hide(500);
                $("#error3").hide(500);
            }
        }
</script>