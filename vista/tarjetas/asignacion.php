<?php
include '../../controlador/controlador_tarjeta.php';
require_once('../grupo/paises.php');
$usuarios=array("Prensa","Invitados especiales","Grupos artísticos","Comité organizador del festival","Técnicos","Personal de apoyo");
$disciplinas=array("Academia","Artes visuales","Artes Plásticas","Performance","Artes visuales","Música","Danza","Circo","Teatro","Sin definir");
$controlTarjetas = new ControladorTarjeta();
$consulta = $controlTarjetas->listarAnfitrionTarjeta();
?>
<head>
    <script src="js/asignacion.js" type="text/javascript"></script>
</head>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<div align="center" style="margin: 30px;">
    <!--<div align="center" id="spinner" style="">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>-->
    <h2>Asignación de tarjetas&nbsp;&nbsp;<i class="fa fa-credit-card"></i></h2>
    <div align="right">
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
                        <th>Tarjeta</th>
                        <th>Nip</th>
                        <th>Saldo</th>
                        <th>Disponible</th>
                        <th>Estatus</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="TablaUsuarioFil">
                    <?php
                    foreach ($consulta as $row):
                        $estatus = "<i class='fa fa-times-circle' style='color:#FF0000;' aria-hidden=true> Desactivado</i>";
                        $tipo="Empleado";
                        $nip="*********";
                        if($row["nip"]==1)$nip="";
                        if($row["estatus"]==1){
                            $estatus="<i class='fa fa-check' style='color:#28B463;' aria-hidden=true> Habilitado</i>";
                        }
                        ?>
                        <tr> 
                            <?php
                            $estat="<font color='#28B463' style='font: normal normal normal 16px/1 FontAwesome;'>Activa</font>";
                            $activar="<a href=# class='eliminar' id='".$row['idTarjeta']."' style='color:#FF0000;' onClick='desactivarTarjeta(this)'><i class='fa fa-minus' aria-hidden=true>&nbsp;&nbsp;Desactivar</i></a>";
                            if($row['estatus']==0){
                                $estat="<font color='red' style='font: normal normal normal 16px/1 FontAwesome;'>Inactiva</font>";
                                $activar="<a href=# class='eliminar' id='".$row['idTarjeta']."' style='color:green;' onClick='activarTarjeta(this)'><i class='fa fa-check' aria-hidden=true>&nbsp;&nbsp;Activar</i></a>";
                            }
                            ?>
                            <td><?=$row['nombre']?></td>
                            <td><?=$usuarios[$row['categoria']]?></td>
                            <td><?=$paises[$row['categoria']]?></td>
                            <td><?=$disciplinas[$row['categoria']]?></td>
                            <td><?=$row['codigo']?></td>
                            <td>****</td>
                            <td>$<?= number_format($row['monto'],2)?></td>
                            <td>$<?=number_format($row['disponible'],2)?></td>
                            <td><?=$estat?></td>
                            <td><a href=javascript:void(0) id="<?= $row['idTarjeta'] ?>" class='editar' onClick="asignarTarjeta(this)"><i class='fa fa-bullseye' aria-hidden=true>&nbsp;&nbsp;Asignar tarjeta</i></a></td>
                            <?php
                            if(!$row['codigo']){
                                echo "<td colspan='2' class='text-center'>"
                                        . "<font color='#909497' style='font: normal normal normal 15px/1 FontAwesome;'>"
                                            . "<i class='fa fa-info-circle' aria-hidden=true>&nbsp;&nbsp;&nbsp;&nbsp;N o&nbsp;&nbsp;&nbsp;&nbsp;a p l i c a</i>"
                                        . "</font>"
                                    . "</td>";
                            }else{?>
                                <td><?=$activar?></td>
                                <td>
                                    <a href=javascript:void(0) id="<?= $row['idAnfitrion'] ?>" class='editar' onClick="historialTarjeta(this)">
                                        <i class='fa fa-shopping-cart' aria-hidden=true>&nbsp;&nbsp;Compras</i>
                                    </a>
                                </td>
                            <?php
                            }
                            ?>
                            <!--
                            <td><?php // echo $row['estatus'];    ?></td>
                            -->
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