<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_persona.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_grupo.php');
$controladorGrupo = new ControladorGrupo();
$model = $controladorGrupo->indexCotizacion($idCotizacion);
$lista_disciplinas = $controladorGrupo->indexDisciplinas();
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
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#anfitrion">REGISTRAR RELACIÓN ANFITRION - GRUPO</a></li>
                    <li><a data-toggle="tab" href="#grupo">ASIGNAR GRUPO A ANFITRIÓN</a></li>
                </ul>
                <form role="form" id="formGroup" id="accion" name="accion" value="1">
                    <input type="hidden" id="accion" name="accion" value="1"/>
                    <div class="tab-content">
                        <div id="anfitrion"  class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div align="center">
                                            <h4>Información de anfitrión</h4>
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <b>Nombre:</b>
                                            <input class="form-control"id="txtNombreP" name="txtNombreP" type="text" placeholder="Nombre de participante" onblur="validarInput(this)"/><span id="spa" name="spa"></span>
                                        </div>
                                        <div class="form-group">
                                            <b>Apellidos:</b>
                                            <input class="form-control" id="txtApP" name="txtApP" type="text" onblur="validarInput(this)"  placeholder="Apellido de participante" />
                                        </div>
                                        <div class="form-group">
                                            <b>Correo:</b>
                                            <input class="form-control" id="txtCorreP" name="txtCorreP" onblur="validarInput(this)" type="text" placeholder="Correo de participante" />
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="grupo"  class="tab-pane fade">
                            <input type="hidden" id="idCotizacion" name="idCotizacion" value="<?= $model[0]["idAnfitrion"] ?>"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div align="center">
                                            <h4>Información de grupo</h4>
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <b>Nombre de grupo:</b>
                                            <input class="form-control"id="txtNombreG" onblur="validarInput(this)" name="txtNombreG" type="text" placeholder="Nombre de grupo" />
                                        </div>
                                        <div class="form-group">
                                            <b>Clave:</b>
                                            <input class="form-control" id="txtClave" onblur="validarInput(this)" name="txtClave" type="text"  placeholder="Clave de grupo" />
                                        </div>
                                        <div class="form-group">
                                            <b>Folio:</b>
                                            <input class="form-control" id="txtFolio" name="txtFolio" onblur="validarInput(this)" type="text" placeholder="Folio de grupo" />
                                        </div>
                                        <div class="form-group">
                                            <b>Número de personas:</b>
                                            <input class="form-control" id="txtNumP" name="txtNumP" onblur="validarInput(this)" type="number" placeholder="Número de personas" />
                                        </div>
                                        <div class="form-group">
                                            <b>Seleccionar disciplina de grupo</b>
                                            <select class="form-control" id="dropDisGrupo" name="dropDisGrupo">
                                                <option value=>Selecciona el disciplina..</option>
                                                <?php
                                                foreach ($lista_disciplinas as $row):
                                                    $disciplinas[$row['idDisciplinas']] = $row['nombre'];
                                                    if ($row['estatus'] != 0) {
                                                        ?>
                                                        <option value="<?= $row['idDisciplina'] ?>"><?= $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php endforeach ?> 
                                            </select>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertPers_grupo()"><i class="fa fa-save"></i> Guardar Relación</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalCotizacion").modal();
    function fase1() {
        $("#grupo").show();
        $("#debilidades").hide();
    }
</script>