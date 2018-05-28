<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_meta.php');
$controladorMeta = new ControladorMeta();
$consulta = $controladorMeta->listarMeta();
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/monto_meta.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalMeta" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Fondo y/o recursos</font></h4>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" id="txtEditarGiro" name="txtEditarGiro">
                    <input type="hidden" id="txtIdGiro" name="txtIdGiro">
                    <div class="form-group text-center">
                        <b>Fondo:</b>
                        <input class="form-control" type="text" id="txtMontoMeta" name="txtMontoMeta" placeholder="$0.00">
                    </div>
                    <div class="form-group text-center">
                        <input type='button' class='btn btn-info' id='guardarGiro' name="guardarGiro" value='Guardar' onclick="insertarMonto()"/>
                    </div>
                    <?php
                    if(!$consulta){
                        echo '<div class="text-center" ><h3><small>No existen registros por el momento</small></h3></div>';
                    }else{
                    ?>
                    <div class="table table-responsive">
                        <table id="TablaMeta" class="table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="info">
                                    <th>Fondo</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="TablaMetaFil">
                                <?php
                                foreach ($consulta as $row):
                                  $estatus="";
                                  if ($row['estatus'] == 1) {
                                  $estatus = "checked";
                                  } 
                                ?>
                                <tr> 
                                    <td>$<?php echo number_format($row['monto'],2);?></td>
                                    <td><?php echo $row['fecha'] ?></td>
                                    <td><input type="radio" id="estado" name="gender" value="<?= $row['idMonto_meta'] ?>" <?=$estatus?>> </td>
                                </tr>

                                <?php endforeach ?>  
                            </tbody>
                            <script>
                                $(document).ready(function () {
                                    $("#myInput").on("keyup", function () {
                                        var value = $(this).val().toLowerCase();
                                        $("#TablaMetaFil tr").filter(function () {
                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                        });
                                    });
                                });
                            </script>
                        </table>
                    </div>
                    <?php } ?>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $("#modalMeta").modal();
</script>