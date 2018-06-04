<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
$idHotel=0;
if(isset($_POST["id"])){
    $idHotel=$_POST["id"];
}
$editar=0;
if(isset($_POST["editar"])){
    $editar=$_POST["editar"];
}
$controlHoteles = new ControladorHotel();
$consulta1 = $controlHoteles->listarHabitaciones($idHotel);
?>
<head>
    <script src="js/hotel.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalHotel" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Administracion de habitaciones</font></h4>
            </div>
            <div class="modal-body">
                <div id="agregarHab" align="right">
                    <a href="javascript:void(0)" onclick="mostrarTipoHabitacion(1)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar habitación</a><br><br>
                </div>
                <div id="regresarHab" align="right" style="display: none;">
                    <a href="javascript:void(0)" onclick="mostrarTipoHabitacion(2)"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a><br><br>
                </div>
                <div id="habitacionesDiv" class="table table-responsive ">
                    <table id="TablaHabitaciones" class="table table-condensed table-striped">
                        <thead>
                            <tr class="info">
                                <th>Habitación</th>
                                <th>Costo</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="TablaCotizacionFil">
                            <?php
                            if($consulta1){
                                foreach ($consulta1 as $row):
                                    ?>
                                    <tr> 
                                        <td><?= $row['nombTipo']; ?></td>
                                        <td>$<?= $row['costo'] ?></td>
                                        <td><a href=javascript:void(0) id="<?= $row['idTipoHab'] ?>" class='editar' onclick="editarHabitacion(this)"><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>
                                        <td><a href=javascript:void(0) class='eliminar' id="<?= $row['idTipoHab'] ?>" style='color:#FF0000;' onclick="eliminarHabitacion(this)"><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td>
                                        <!--
                                        <td><?php // echo $row['estatus'];      ?></td>
                                        -->
                                    </tr>

                                <?php endforeach ;
                                } else {
                                    echo '<tr id="msjtabla"><td colspan="4"><h2><small>No existen registros almacenados</small></h2></td></tr>';
                                }?> 
                        </tbody>
                    </table>
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
                    <div id="modalform"></div>
                </div>
                <form id="nuevaHabitacion" style="display: none;">
                    <input type="hidden" id="accion" name="accion" value="3"/>
                    <input type="hidden" id="txtEditarHabitacion" name="txtEditarHabitacion" value="0">
                    <input type="hidden" id="txtIdHotel" name="txtIdHotel" value="<?=$idHotel?>">
                    <input type="hidden" id="txtIdHabitacion" name="txtIdHabitacion" value="0">
                    <div class="form-group">
                        <label for="usrname"><span class="fa fa-home"></span> Habitación</label>
                        <input type="text" class="form-control" id="txtNombreHab" name="txtNombreHab" placeholder="nombre habitación">
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Costo</label>
                        <input type="number" class="form-control" id="txtCostoHab" name="txtCostoHab" placeholder="0.00">
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-success btn-block button" onclick="registrarHabitacion()"> Consultar</button>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
    </div>
</div>
<div id="modalform"></div>
<script>
    $("#modalHotel").modal();
</script>