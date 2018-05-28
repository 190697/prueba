<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_persona.php');

?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/personas.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalCotizacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar participantes</font></h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="idCotizacion" name="idCotizacion" value="<?=$model[0]["idAnfitrion"]?>"/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div align="center">
                                    <h4>Información de anfitrión</h4>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <b>Nombre:</b>
                                    <input class="form-control"id="txtNombreP" name="txtNombreP" type="text" placeholder="Nombre de participante" />
                                </div>
                                <div class="form-group">
                                    <b>Apellidos:</b>
                                    <input class="form-control" id="txtApP" name="txtApP" type="text"  placeholder="Apellido de participante" />
                                </div>
                                <div class="form-group">
                                    <b>Correo:</b>
                                    <input class="form-control" id="txtCorreP" name="txtCorreP" type="text" placeholder="Correo de participante" />
                                </div>
                                <!---->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarPersona()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalCotizacion").modal();
</script>
