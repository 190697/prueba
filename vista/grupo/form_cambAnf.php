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
                        <div class="col-md-12">
                            <div align="center">
                                <h4>Integrantes del grupo</h4>
                                <hr>
                            </div>
  <?php
                if (!$lista_integrantes) {
                    echo '<div class="text-center" style="padding-top: 60px;"><h2><small>No existen registros almacenados</small></h2></div>';
                }else{
                    ?><!--
                                <div id="alertSeg" class="text-center alert-info" style="color:red;">
                                    <b><i class="fa fa-info-circle"></i> Click para finalizar seguimiento</b>
                                </div>-->
                    <table id="TablaCotizaciones" class="table table-condensed table-hover">
                        <thead>
                            <tr class="info">
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Genero</th>
                                <th>Correo</th>                              
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="TablaCotizacionFil">
                            <?php
                            foreach ($lista_integrantes as $row):
                                if($row["esAnfitrion"]==1){
                                ?>
                                <tr style="background: #85C1E9;"> 
                                    <td><?= $row["nombre"] ?></td>
                                    <td><?= $row["apellidos"] ?></td>
                                    <td><?= $row["genero"] ?></td>
                                    <td><?= $row["correo"] ?></td>
                                    <td>
                                        ANFITRION
                                    </td>
                                </tr>
                                <?php }else{?>
                                <tr> 
                                    <td><?= $row["nombre"] ?></td>
                                    <td><?= $row["apellidos"] ?></td>
                                    <td><?= $row["genero"] ?></td>
                                    <td><?= $row["correo"] ?></td>
                                    <td>
                                        <a href=javascript:void(0) data-value="vista/grupo/form_grupo.php?idGrupo=<?= 22?>" onclick="modal(this)">
                                            <i class="fa fa-edit"></i>&nbsp;&nbsp;Asignar como anfitrion
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                }
?>
                            <?php endforeach ?>  
                        </tbody>
                        <script>
                            $(document).ready(function () {
                                $("#myInput").on("keyup", function () {
                                    var value = $(this).val().toLowerCase();
                                    $("#TablaCotizacionFil tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>
                    </table>
                <?php }?>
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
    color: white;
    background-color: #d8da3d }
  </style>
<script>
    $("#modalCotizacion").modal();
</script>