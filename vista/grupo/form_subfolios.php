<?php if (isset($_GET["idGrupo"])) {
    include ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_index.php');
    $controlIndex = new ControladorIndex();
    $image="";
    $idGrupo=$_GET["idGrupo"];
    $consulta = $controlIndex->indexSubfolios($idGrupo);
    if (isset($_GET["image"])) {
        $image=$_GET["image"];
    }?>
    <head>
        <script src="js/grupo.js" type="text/javascript"></script>
    </head>
    <div class="modal fade" id="modalCotizacion" role="dialog">
        <div class="modal-dialog modal-lg">
            <form enctype="multipart/form-data" class="formulario">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center"><font color="white">Subfolios<br><small style="color: white;">(Selecciona una opción)</small></font></h4>
                    </div>
                    <div class="modal-body text-center"> 
                        <input type="hidden" id="actualizarCot" name="actualizarCot" value="<?= $_GET["idGrupo"] ?>">
                        <input type="hidden" id="idGrupo" name="idGrupo" value="<?= $_GET["idGrupo"] ?>">
                        <div><h4>Folio de grupo: <small><?=$_GET["folio"]?></small></h4></div>
                        <div class="form-group">
                            <b>Subfolio</b>
                            <input type="text" class="form-control" id="txtSubFolio" name="txtSubFolio" placeholder="<?=$_GET["folio"]?>">
                            <div id="xmail2" class="hide text-center"><h5 class="text-danger">Se debe ingresar un subfolio</h5></div><br>
                            <a href=javascript:void(0) class="btn btn-info" onclick="insertarSubfolio()">
                                <i class="fa fa-save" aria-hidden="true"></i> Guardar Subfolio
                            </a>
                        </div>
                        <?php
                        if (!$consulta) {
                            echo '<div class="text-center" style="padding-botom: 30px;"><h2><small>No existen subfolios registrados</small></h2></div>';
                        } else {
                        ?>
                            <table id="tabSubfolio" class="table table-condensed table-hover table-striped">
                                <thead>
                                    <tr class="alert-info">
                                        <th>Subfolio</th>
                                        <th>F/Registro</th>
                                        <!--<th></th>
                                        <th></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;   
                                    foreach ($consulta as $row):
                                        ?>
                                    <tr> 
                                        <td><?=$row["folio"]?></td>
                                        <td><?=$row["fecha"]?></td>
                                        <!--<td>
                                            <a href=javascript:void(0) onclick="modal(this)">
                                                <i class="fa fa-qrcode"></i>&nbsp;&nbsp;Subfolios
                                            </a>
                                        </td>
                                        <td>
                                            <a href=javascript:void(0) onclick="modal(this)">
                                                <i class="fa fa-qrcode"></i>&nbsp;&nbsp;Editar
                                            </a>
                                        </td>-->
                                    </tr>

                                    <?php endforeach ?>  
                                </tbody>
                            </table>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
                </form>
        </div>
    </div>
    <script>
        $("#modalCotizacion").modal();
    </script>

    <?php
}
?>