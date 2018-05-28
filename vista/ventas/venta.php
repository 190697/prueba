<?php
include '../../controlador/controlador_venta.php';
require_once('../grupo/paises.php');
$controlVentas = new ControladorVenta();
$consulta = $controlVentas->listarMovimientosTarjeta();
$usuarios=array("Prensa","Invitados especiales","Grupos artísticos","Comité organizador del festival","Técnicos","Personal de apoyo");
$disciplinas=array("Academia","Artes visuales","Artes Plásticas","Performance","Artes visuales","Música","Danza","Circo","Teatro","Sin definir");
?>
<head>
    <script src="js/usuario.js" type="text/javascript"></script>
</head>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div align="center" style="margin: 30px;">
    <!--<div align="center" id="spinner" style="">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>-->
    <h2>Módulo de Ventas</h2>
    <div align="right">
        <a href=javascript:void(0) data-value="vista/ventas/form_venta.php" onclick="modal(this)"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva venta</a><br><br>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <input class="form-control" id="myInput" type="text" placeholder="Filtrar.."><br>
        </div>
    </div>
    <?php
    if (!$consulta) {
        echo '<div class="text-center" style="padding-top: 60px;"><h2><small>No existen registros almacenados</small></h2></div>';
    } else {
        ?>
        <div class="table table-responsive">
            <table id="TablaUsuario" class="table table-condensed table-hover table-striped">
                <thead><!--
                    <tr>
                        <th class="text-center" colspan="4" style="border: 1px solid;">
                            <b>Información usuario</b>
                        </th>
                        <th class="text-center" colspan="5" style="border: 1px solid;">
                            <b>Información Tarjeta</b>
                        </th>
                    </tr>-->
                    <tr class="info">
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Pais</th>
                        <th>Disciplina</th>
                        <th>Servicio</th>
                        <th>Detalle</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="TablaUsuarioFil">
                    <?php
                    foreach ($consulta as $row):
                        ?>
                        <tr> 
                            <td><?=$row['nombre']?></td>
                            <td><?=$usuarios[$row['categoria']]?></td>
                            <td><?=$paises[$row['categoria']]?></td>
                            <td><?=$disciplinas[$row['categoria']]?></td>
                            <td><?=$row['servicio']?></td>
                            <td><?=$row['detalle']?></td>
                            <td>$<?= number_format($row['subtotal'],2);?></td>
                        </tr>

                    <?php endforeach ?>  
                </tbody>
            </table>
        </div>
    <?php }?>
</div>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#TablaUsuarioFil tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>