<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_grupo.php');
require_once('paises.php');
$idCotizacion = 0;
$edicion="";
if (isset($_POST["id"])) {
    $idCotizacion = $_POST["id"];
}
$editar = 0;
if (isset($_POST["editar"])) {
    $editar = $_POST["editar"];
}
$usuarios=array("Prensa","Invitados especiales","Grupos artísticos","Comité organizador del festival","Técnicos","Personal de apoyo");
$disciplinas=array();
$controladorGrupo = new ControladorGrupo();
$model = $controladorGrupo->indexCotizacion($idCotizacion);
$lista_disciplinas = $controladorGrupo->indexDisciplinas();
if(!$model){
    $model[0]["idAnfitrion"]="";
    $model[0]["antitrion"]="";
    $model[0]["categoria"]="";
    $model[0]["pais"]="";
    $model[0]["disciplina"]="";
    $model[0]["nombre"]="";
    $model[0]["clave"]="";
    $model[0]["folio"]="";
    $model[0]["num_personas"]="";
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
                <form>
                    <input type="hidden" id="idCotizacion" name="idCotizacion" value="<?=$model[0]["idAnfitrion"]?>"/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div align="center">
                                    <h4>Información de anfitrión</h4>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <b>Nombre de anfitrión</b>
                                    <input class="form-control" <?=$edicion?> id="txtNombreA" name="txtNombreA" type="text" value="<?=$model[0]["antitrion"]?>" placeholder="Nombre de anfitrión" />
                                </div>
                                <!---->
                                <div class="form-group">
                                    <b>Categoria de usuario</b>
                                    <select class="form-control" id="dropCatUsuario">
                                        <option>Selecciona la categoria..</option>
                                        <?php
                                        $i=0;
                                        foreach ($usuarios as $row) {
                                            $seleccion="";
                                            if($model[0]["categoria"]==$i)$seleccion="selected";
                                            echo "<option value='$i' $seleccion>$row</option>";
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <b>País o región</b>
                                    <select class="form-control" id="dropPaisUsuario">
                                        <option>Selecciona pais/region..</option>
                                        <?php
                                        $i=0;
                                        foreach ($paises as $row) {
                                            $seleccion="";
                                            if($model[0]["pais"]==$i)$seleccion="selected";
                                            echo "<option value='$i' $seleccion>$row</option>";
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <b>Disciplina</b>
                                    <select class="form-control" id="dropDisUsuario">
                                        <option value=>Selecciona el disciplina..</option>
                                        <?php
                                        foreach ($lista_disciplinas as $row):
                                            $disciplinas[$row['idDisciplinas']]=$row['nombre'];
                                            if($row['estatus']!=0){?>
                                                <option value="<?=$row['idDisciplina']?>"><?=$row['nombre']?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php 
                                        endforeach ?> 
                                    </select>
                                </div>
                                <!---->
                            </div>
                            <div class="col-md-6">
                                <div align="center">
                                    <h4>Información de grupo</h4>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <b>Nombre del grupo *</b>
                                    <input class="form-control" <?=$edicion?> id="txtNombreGrupo" name="txtNombreGrupo" type="text" value="<?=$model[0]["nombre"]?>" placeholder="Nombre del grupo *" />
                                </div>
                                <div class="form-group">
                                    <b>Clave del grupo *</b>
                                    <input class="form-control" <?=$edicion?> id="txtClaveGrup" name="txtClaveGrup" type="text" value="<?=$model[0]["clave"]?>" placeholder="Clave y/o nomenclatura" />
                                </div>
                                <div class="form-group">
                                    <b>Folio del grupo *</b>
                                    <input class="form-control" <?=$edicion?> id="txtFolioGrup" name="txtFolioGrup" type="text" value="<?=$model[0]["folio"]?>" placeholder="Folio del grupo *"  maxlength="10" />
                                </div>
                                <div class="form-group">
                                    <b>Numero de personas *</b>
                                    <input class="form-control" <?=$edicion?> id="txtPersonaGru" name="txtPersonaGru" type="number" value="<?=$model[0]["num_personas"]?>" placeholder="Nº de personas *"  maxlength="10" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert-danger text-center" style="font-size: 11px;font-weight: bold;">Campos requeridos *</div>
            <div class="modal-footer">
                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="insertarGrupoAnfitrion()"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalCotizacion").modal();
</script>