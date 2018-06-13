<?php
session_start();
include '../../controlador/controlador_hotel.php';
$controlHoteles = new ControladorHotel();
$consulta1 = $controlHoteles->listarSolicitudes($_SESSION["idHotel"]);
?>
<head>
    <script src="js/hotel.js" type="text/javascript"></script>
</head>
<input type="hidden" id="formUrl" name="formUrl" value="home">
<div class="col-md-12 text-center">
    <h2>Solicitudes de hospedaje&nbsp;&nbsp;<i class="fa fa-home"></i></h2>
    <div align="right" class="col-md-12">
        <input class="form-control" id="myInput" type="text" placeholder="Filtrar grupo por cualquier columna..">
    </div>
    <br><br>
    <?php
    if($consulta1){?>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Solicitudes generales de hospedaje</div>
            <div class="panel-body">
                <div class="table table-responsive panelinicio text-left">
                    <table id="TablaEmpresas" class="table table-condensed table-striped">
                        <thead>
                            <tr class="info">
                                <th>Nº</th>
                                <th>Grupo</th>
                                <th>Folio</th>
                                <th>Subfolio</th>
                                <th>Fecha entrada</th>
                                <th>Fecha salida</th>
                                <th>Habitación</th>
                                <th>Habitaciones</th>
                                <th>Num. noches</th>
                                <th>Tarifa</th>
                                <th>Total Hospedaje</th>
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="TablaCotizacionFil">
                            <?php
                            $i=1;
                            foreach ($consulta1 as $row):
                                $salida=$row['fechaSalida'];
                                $respuesta="<i class='fa fa-envelope' aria-hidden=true>&nbsp;&nbsp;Enviar Respuesta</i>";
                                if(!$salida)$salida="Pendiente";
                                $estatus='<i style="color:blue;" class="fa fa-clock-o" aria-hidden="true"></i>';
                                if($row["estatus"]!=1)$respuesta="<i class='fa fa-envelope' aria-hidden=true>&nbsp;&nbsp;Editar Respuesta</i>";
                                if($row["estatus"]==2){
                                    $estatus='<i style="color:green;" class="fa fa-check" aria-hidden="true"></i>';
                                }elseif($row["estatus"]==3){
                                    $estatus='<i style="color:red;" class="fa fa-times-circle-o" aria-hidden="true"></i>';
                                }
                                ?>
                                <tr> 
                                    <td><b><?=$i?></b></td>
                                    <td><?= $row['nombre']; ?></td>
                                    <td><?= $row['folio']; ?></td>
                                    <td><?= $row['subfolio']; ?></td>
                                    <td><?= $row['fechaEntrada']; ?></td>
                                    <td><?= $salida ?></td>
                                    <td><?= $row['habitacion']; ?></td>
                                    <td><?= $row['num_habitaciones']; ?></td>
                                    <td><?= $row['num_noches']; ?></td>
                                    <td>$<?= number_format($row['costo'],2); ?></td>
                                    <td>$<?= number_format($row['total'],2); ?></td>
                                    <td><?=$estatus?></td>
                                    <td>
                                        <a href=javascript:void(0) id="li<?=$i?>" form="vista/hotel/_respuestaForm.php?id=<?=$row['idEstancia'];?>&estatus=<?=$row['estatus'];?>" onclick="respuestaForm(this)">
                                            <?=$respuesta?>
                                        </a>
                                        <i id="SpinnPrincipali<?=$i?>" style="display: none;" class="fa fa-spinner fa-spin"></i>
                                    </td>
                                </tr>

                            <?php 
                            $i++;
                            endforeach ;?>
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
            </div>
        </div>
    <?php
    }else{
        echo '<div class="text-center"><h2><small>No existen registros almacenados</small></h2></div>';
    }
    ?>
</div>
<script>
    //recargarGraficas();
    $(".panelinicio").slideDown(700);
    /*
     function proceso() {
     console.log("HOLA MUNDO");
     }
     if(clearInterval(myVar)){
     var myVar=setInterval(proceso,2000);
     }else{
     var myVar=setInterval(proceso,2000);
     }
     */
</script>