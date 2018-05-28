<?php
include '../../controlador/controlador_hotel.php';
$controlHoteles = new ControladorHotel();
$consulta1 = $controlHoteles->listarHoteles();
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/hotel.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalHotel" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Administracion de Hoteles</font></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="div_tabla_estrategias" class="col-md-12">
                        <div class="col-md-12 table-responsive">
                            <div align="right">
                                <a href="javascript:void(0)" id="linkModal" form="vista/hotel/form_hotel.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo hotel</a><br><br>
                            </div>
                            <table id="TablaEmpresas" class="table table-condensed table-striped">
                                <thead>
                                    <tr class="info">
                                        <th>Nombre</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($consulta1){
                                        foreach ($consulta1 as $row):
                                            ?>
                                            <tr> 
                                                <td><?= $row['nombre']; ?></td>
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
                        </div>
                    </div>
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