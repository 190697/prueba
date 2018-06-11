<?php
include '../../controlador/controlador_index.php';
$controlHoteles = new ControladorIndex();
$consulta1 = $controlHoteles->layout();
?>
<input type="hidden" id="formUrl" name="formUrl" value="home">
<div class="col-md-12 text-center">
    <h2>Layout</h2>
    <div align="right" class="col-md-10">
        <input class="form-control" id="myInput" type="text" placeholder="Filtrar por cualquier columna de la tabla...">
    </div>
    <br><br>
    <form action='ajax/ajax_inicio.php' method='post' target='_blank' id='FormularioExportacion'>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Hoteles</div>
            <div class="panel-body">
                <div class="table table-responsive panelinicio">
                    <table id="TablaEmpresas" class="table table-condensed table-striped text-left">
                        <thead>
                            <tr class="info">
                                <th>PAIS REGION</th>
                                <th>DISCIPLINA</th>
                                <th>HOTEL</th>
                                <th>CLAV</th>
                                <th>FOL</th>
                                <th>SUBF</th>
                                <th>NOMBRE</th>
                                <th>IN</th>
                                <th>ULTIMA NOCHE</th>
                                <th>HABITACIÓN</th>
                                <th>HAB/NOCHE</th>
                                <th>NO NOCH</th>
                                <th>TARIFA</th>
                                <th>TOTAL HOSPEDAJE</th>
                            </tr>
                        </thead>
                        <tbody id="TablaCotizacionFil">
                            <?php
                            if($consulta1){
                                foreach ($consulta1 as $row):
                                    $salida=$row['fechaSalida'];
                                     if(!$salida)$salida="Pendiente";
                                    ?>
                                    <tr> 
                                        <td><?= $row['pais']; ?></td>
                                        <td><?= $row['disciplina']; ?></td>
                                        <td><?= $row['hotel']; ?></td>
                                        <td><?= $row['clave']; ?></td>
                                        <td><?= $row['folio']; ?></td>
                                        <td><?= $row['subfolio']; ?></td>
                                        <td><?= $row['nombre']; ?></td>
                                        <td><?= $row['fechaEntrada']; ?></td>
                                        <td><?= $salida ?></td>
                                        <td><?= $row['habitacion']; ?></td>
                                        <td><?= $row['num_habitaciones']; ?></td>
                                        <td><?= $row['num_noches']; ?></td>
                                        <td>$<?= number_format($row['costo'],2); ?></td>
                                        <td>$<?= number_format($row['total'],2); ?></td>
                                        
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
        <input type='button' class='btn btn-success' id='botonExcel' value='Exportar a excel' onClick='enviar_tabla("TablaEmpresas")'/>
                <input type='hidden' id='accion' name='accion' value='7' />
                <input type='hidden' id='datos_a_enviar' name='datos_a_enviar' />
    </form>
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