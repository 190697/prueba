<?php
include '../../controlador/controlador_hotel.php';
$controlHoteles = new ControladorHotel();
$consulta1 = $controlHoteles->listarHoteles();
?>
<head>
    <script src="js/hotel.js" type="text/javascript"></script>
</head>
<input type="hidden" id="formUrl" name="formUrl" value="home">
<div class="col-md-12 text-center">
    <h2>Administración de Hoteles&nbsp;&nbsp;<i class="fa fa-building-o"></i></h2>
    <div align="right" class="col-md-10">
        <input class="form-control" id="myInput" type="text" placeholder="Filtrar grupo por cualquier columna..">
    </div>
    <div align="right" class="col-md-2">
        <a href="javascript:void(0)" id="linkModal" form="vista/hotel/form_hotel.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo hotel</a>
    </div>
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Hoteles</div>
        <div class="panel-body">
            <div class="table table-responsive panelinicio">
                <table id="TablaEmpresas" class="table table-condensed table-striped">
                    <thead>
                        <tr class="info">
                            <th>Nombre</th>
                            <th>Correo/usuario</th>
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
                                        <a href=javascript:void(0) id="<?= $row['idHotel'] ?>" class='editar' onclick="habitacionesHotel(this)">
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
        </div>
    </div>
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