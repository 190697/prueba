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
                                    <td><?= $row['correo']; ?></td>
                                    <td><?= $row['correo']; ?></td>
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