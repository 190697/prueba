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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Administracion de habitaciones</font></h4>
            </div>
            <div class="modal-body">
                <div align="right">
                    <a href="javascript:void(0)" id="linkModal" form="vista/restaurant/form_restaurant.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo restaurant</a><br><br>
                </div>
                <div class="table table-responsive panelinicio">
                    <table id="TablaEmpresas" class="table table-condensed table-striped">
                        <thead>
                            <tr class="info">
                                <th>Nombre</th>
                                <th></th>
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
                                        <td><?= $row['correo']; ?></td>
                                        <td>
                                            <a href=javascript:void(0) id="<?= $row['idHotel'] ?>" class='editar' onclick="editarHotel(this)">
                                                <i class='fa fa-home' aria-hidden=true>&nbsp;&nbsp;Habitaciones</i>
                                            </a>
                                        </td>
                                        <td><a href=javascript:void(0) id="<?= $row['idHotel'] ?>" class='editar' onclick="editarHotel(this)"><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>
                                        <td><a href=javascript:void(0) class='eliminar' id="<?= $row['idHotel'] ?>" style='color:#FF0000;' onclick="eliminarHotel(this)"><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td>
                                        <!--
                                        <td><?php // echo $row['estatus'];      ?></td>
                                        -->
                                    </tr>

                                <?php endforeach ;
                                } else {
                                    echo '<div class="text-center"><h2><small>No existen registros almacenados</small></h2></div>';
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
                <br><br>
            </div>
        </div>
    </div>
</div>
<div id="modalform"></div>
<script>
    $("#modalHotel").modal();
</script>