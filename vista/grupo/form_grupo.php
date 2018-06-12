<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_grupo.php');
require_once('paises.php');
$idCotizacion = 0;
$edicion = "";
$idCotizacion = $_GET["idGrupo"];
$usuarios = array("Prensa", "Invitados especiales", "Grupos artísticos", "Comité organizador del festival", "Técnicos", "Personal de apoyo");
$disciplinas = array();
$controladorGrupo = new ControladorGrupo();
$model = $controladorGrupo->indexCotizacion($idCotizacion);
$lista_disciplinas = $controladorGrupo->indexDisciplinas();
$lista_integrantes = $controladorGrupo->integrantesGrupo($idCotizacion);
if (!$model) {
    $model[0]["idAnfitrion"] = "";
    $model[0]["antitrion"] = "";
    $model[0]["categoria"] = "";
    $model[0]["pais"] = "";
    $model[0]["disciplina"] = "";
    $model[0]["nombre"] = "";
    $model[0]["clave"] = "";
    $model[0]["folio"] = "";
    $model[0]["num_personas"] = "";
}
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/grupo.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalCotizacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Registrar/editar grupo</font></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idCotizacion" name="idCotizacion" value="<?= $model[0]["idGrupo"] ?>"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div align="center">
                                <h4>Información de grupo</h4>
                                <hr>
                            </div>
                              <b>Categoria de grupo:</b>
                                        <select class="form-control" name="dropCate" id="dropCate" onchange="recargarTipos()">
                                            <option value="cat">Selecciona categoria..</option>
                                            <?php
                                            $i = 0;
                                            foreach ($categoria as $row):
                                                ?>
                                                <option value="<?= $i ?>"><?= $row ?></option>
                                                <?php
                                                ?>
                                                <?php
                                                $i++;
                                            endforeach
                                            ?> 
                                        </select>
                                        <div class="form-group" id="divTip" style="display: none;">
                                            <br>
                                            <b>Subcategoria de grupo:</b>
                                            <select class="form-control" name="dropTipo" id="dropTipo">
                                                <option value="op">Selecciona subcategoria..</option>
                                                <?php
                                                $i = 0;
                                                foreach ($subcategoria as $row):
                                                    ?>
                                                    <option value="<?= $i ?>"><?= $row ?></option>
                                                    <?php
                                                    ?>
                                                    <?php
                                                    $i++;
                                                endforeach
                                                ?> 
                                            </select>
                                        </div>
                            <b>Nombre de grupo</b>
                            <div class="input-group">
                                <input class="form-control" id="txtNGrupo" name="txtNGrupo" type="text" onblur="validarInput(this)" value="<?= $model[0]["nGrupo"] ?>" />
                                <span class="input-group-addon"  id="txtNGrupo"></span>
                            </div>
                            <b>Clave:</b>
                            <div class="input-group">
                                <input class="form-control" id="txtClave" onblur="validarInput(this)" name="txtClave" value="<?= $model[0]["clave"] ?>" type="text"  placeholder="Clave de grupo" />
                                <span class="input-group-addon"  id="txtClaveEsp"></span>
                            </div>
                            <b>Folio:</b>
                            <div class="input-group">
                                <input class="form-control" id="txtFolio" name="txtFolio" value="<?= $model[0]["folio"] ?>"onblur="validarInput(this)" type="text" placeholder="Folio de grupo" />
                                <span class="input-group-addon"  id="txtFolioEsp"></span>
                            </div>
                            <b>Número de personas:</b>
                            <div class="input-group">
                                <input class="form-control" id="txtNumP" name="txtNumP" onblur="validarInput(this)" value="<?= $model[0]["num_personas"] ?>"type="number" placeholder="Número de personas" />
                                <span class="input-group-addon"  id="txtNumPEsp"></span>
                            </div>
                            <div class="form-group">
                                <b>Seleccionar disciplina de grupo</b>
                                <select class="form-control" id="dropDisGrupo" name="dropDisGrupo">
                                    <option value=>Selecciona la disciplina..</option>
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
                            <div class="form-group">
                                <b>Pais</b>
                                <select class="form-control" name="dropPais" id="dropPais">
                                    <option value=>Selecciona pais..</option>
                                    <?php
                                    $i = 0;
                                    foreach ($paises as $row):
                                        ?>
                                        <option value="<?= $i ?>"><?= $row ?></option>
                                        <?php
                                        ?>
                                        <?php
                                        $i++;
                                    endforeach
                                    ?> 
                                </select>
                            </div>
                            <div align="center">
                                <button class="btn btn-warning" id="guardarGiro" name="guardarGiro" onclick="actualizarGrupo()"><i class="fa fa-save"></i> Editar información</button>
                            </div><br>
                        </div>
                        <div class="col-md-6">
                            <div align="center">
                                <h4>Integrantes del grupo</h4>
                                <hr>
                            </div>
                            <?php
                            if (!$lista_integrantes) {
                                echo '<div class="text-center" style="padding-top: 60px;"><h2><small>No existen registros almacenados</small></h2></div>';
                            } else {
                                ?><!--
                                                        <div id="alertSeg" class="text-center alert-info" style="color:red;">
                                                            <b><i class="fa fa-info-circle"></i> Click para finalizar seguimiento</b>
                                                        </div>-->
                                <div class="form-group">
                                    <center>
                                        <b>SELECCIONE INTEGRANTE A EDITAR</b>
                                    </center>
                                    <select class="form-control" id="dropIntegr" name="dropIntegr" onchange="recargarIntegrantes()">
                                        <option value=>Seleccione integrante a modificar..</option>
                                        <?php
                                        foreach ($lista_integrantes as $row):
                                            ?>
                                            <option value="<?= $row['idPersona'] ?>"><?= $row['nombre'] . " " . $row["apellidos"] ?></option>
                                            <?php
                                            ?> 
                                        <?php endforeach ?> 
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group" id="divHab" style="display: none;">
                                <input type="hidden" id="idPers" name="accion"/>
                                <b>Datos de integrante:</b><br>
                                <b>Nombre:</b>
                                <div class="input-group">
                                    <input class="form-control"id="txtNombreP" name="txtNombreP" type="text" placeholder="Nombre de participante" onblur="validarInput(this)"/>
                                    <span class="input-group-addon"  id="txtNombrePEsp"></span>
                                </div>
                                <b>Apellidos:</b>
                                <div class="input-group">
                                    <input class="form-control"id="txtApellido" name="txtApellido" type="text" placeholder="Nombre de participante" onblur="validarInput(this)"/>
                                    <span class="input-group-addon"  id="txtApellidoEsp"></span>
                                </div>
                                <b>Correo:</b>
                                <div class="input-group">
                                    <input class="form-control"id="txtCorreo" name="txtApellido" type="text" placeholder="Nombre de participante" onblur="validarInput(this)"/>
                                    <span class="input-group-addon"  id="txtCorreoEsp"></span>
                                </div><br>
                                <div align="center">
                                    <button class="btn btn-warning" id="guardarGiro" name="guardarGiro" onclick="actualizarIntegrante()"><i class="fa fa-save"></i> Editar integrante</button>
                                </div><br>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>

            </div>

        </div>

    </div>
</div>
<style type="text/css">
    anfitrion {
        border-radius: 25px 25px 25px 25px;
        -moz-border-radius: 25px 25px 25px 25px;
        -webkit-border-radius: 25px 25px 25px 25px;
        border: 0px solid #000000;}
</style>
<script>
    $("#modalCotizacion").modal();
</script>