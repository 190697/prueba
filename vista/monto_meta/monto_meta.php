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
                        <b>Fondo hacia Hospedaje:</b>
                        <input class="form-control" type="text" id="txtMontoAlim" name="txtMontoMeta" placeholder="$0.00">
                    </div>
                    <div class="form-group text-center">
                        <b>Fondo hacia Alimentos:</b>
                        <input class="form-control" type="text" id="txtMontoHosp" name="txtMontoMeta" placeholder="$0.00">
                    </div>
                    <div class="form-group text-center">
                        <input type='button' class='btn btn-info' id='guardarGiro' name="guardarGiro" value='Guardar' onclick="insertarMonto()"/>
                    </div>
                    <?php
                    if (!$consulta) {
                        echo '<div class="text-center" ><h3><small>No existen registros por el momento</small></h3></div>';
                    } else {
                        ?>
                        <div class="table table-responsive">
                            <table id="TablaMeta" class="table table-condensed table-hover table-striped">
                                <thead>
                                    <tr class="info">
                                        <th>Fondo Alimenticio</th>
                                        <th>Fondo Hospedaje</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Estatus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="TablaMetaFil">
                                    <?php
                                    foreach ($consulta as $row):
                                        $estatus = "";
                                        if ($row['estatus'] == 1) {
                                            $estatus = "checked";
                                        }
                                        ?>
                                        <tr> 
                                            <td>$<?php echo number_format($row['montoAlimen'], 2); ?></td>
                                            <td>$<?php echo number_format($row['montoHosped'], 2); ?></td>
                                            <td><?php echo $row['fechaIn'] ?></td>
                                            <td><?php echo $row['fechaFin'] ?></td>
                                            <td><input type="radio" id="estado" name="gender" value="<?= $row['montoAlimen'] ?>" <?= $estatus ?>> </td>
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