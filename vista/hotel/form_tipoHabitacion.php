<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
$controlHoteles = new ControladorHotel();
$consulta1 = $controlHoteles->listarTipoHabitaciones();
?>
<head>
    <script src="js/hotel.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalHabitacion" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Administración de habitaciones</font></h4>
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
                                <th>Detalle</th>
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
                                        <td><?= $row['nombre']; ?></td>
                                        <td><?= $row['descripcion'] ?></td>
                                        <td><a href=javascript:void(0) id="<?= $row['idHabitacion'] ?>" class='editar' onclick="editarHabitacion(this)"><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>
                                        <td><a href=javascript:void(0) class='eliminar' id="<?= $row['idHabitacion'] ?>" style='color:#FF0000;' onclick="eliminarHabitacion(this)"><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td>
                                        <!--
                                        <td><?php // echo $row['estatus'];      ?></td>
                                        -->
                                    </tr>

                                <?php endforeach ;
                                } else {
                                    echo '<tr id="msjtabla" style="text-align:center;"><td colspan="4"><h2><small>No existen registros almacenados</small></h2></td></tr>';
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
                    <input type="hidden" id="accion" name="accion" value="5"/>
                    <input type="hidden" id="txtEditarHabitacion" name="txtEditarHabitacion" value="0">
                    <input type="hidden" id="txtIdHabitacion" name="txtIdHabitacion" value="0">
                    <div class="form-group">
                        <label for="usrname"><span class="fa fa-home"></span> Habitación</label>
                        <input type="text" class="form-control" id="txtHabitacion" name="txtHabitacion" placeholder="Nombre habitación">
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Descripción</label>
                        <input type="text" class="form-control" id="txtDetalleHab" name="txtDetalleHab" placeholder="Descripcion y/o detalle de habitación">
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-info btn-block button" onclick="registrarHabitacion()"><span class="fa fa-save"></span> Resgistrar</button>
                    </div>
                </form>
                <br><br>
            </div>
        </div>
    </div>
</div>
<div id="modalform"></div>
<script>
    $("#modalHabitacion").modal();
</script>