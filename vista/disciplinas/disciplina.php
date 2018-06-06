<?php
include '../../controlador/controlador_disciplina.php';
$controlDisciplinas = new ControladorDisciplina();
$consulta1 = $controlDisciplinas->listarDisciplinas();
?>
<head>
    <script src="js/disciplina.js" type="text/javascript"></script>
</head>
<input type="hidden" id="formUrl" name="formUrl" value="home">
<div class="col-md-12 text-center">
    <h2>Administración de Disciplinas&nbsp;&nbsp;<i class="fa fa-cubes"></i></h2>
    <div align="right" class="col-md-10">
        <input class="form-control" id="myInput" type="text" placeholder="Filtrar grupo por cualquier columna..">
    </div>
    <div align="right" class="col-md-2">
        <a href="javascript:void(0)" id="linkModal" form="vista/disciplinas/form_disciplina.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva disciplina</a>
    </div>
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Restaurantes</div>
        <div class="panel-body">
            <form action='ajax/ajax_inicio.php' method='post' target='_blank' id='FormularioExportacion'>
                <div id="div_tabla_estrategias" class="col-md-12">
                    <div class="col-md-12 table-responsive panelinicio">
                        <table id="TablaEmpresas" class="table table-condensed table-striped tablaCat">
                            <thead>
                                <tr class="info">
                                    <th>Nombre</th>
                                    <th>descripción</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="TablaCotizacionFil">
                                <?php
                                if($consulta1){?>
                                <?php
                                    foreach ($consulta1 as $row):
                                        ?>
                                        <tr> 
                                            <td><?= $row['nombre']; ?></td>
                                            <td><?= $row['descripcion']; ?></td>
                                            <td><a href=javascript:void(0) id="<?= $row['idDisciplina'] ?>" class='editar' onclick="editarDisciplina(this)"><i class='fa fa-pencil' aria-hidden=true>&nbsp;&nbsp;Editar</i></a></td>
                                            <td><a href=javascript:void(0) class='eliminar' id="<?= $row['idDisciplina'] ?>" style='color:#FF0000;' onclick="eliminarDisciplina(this)"><i class='fa fa-trash-o' aria-hidden=true>&nbsp;&nbsp;Eliminar</i></a></td>
                                            <!--
                                            <td><?php // echo $row['estatus'];      ?></td>
                                            -->
                                        </tr>

                                    <?php endforeach ;
                                    ?>
                                <?php
                                } else {
                                    echo '<div class="text-center"><h2><small>No existen registros almacenados</small></h2></div>';
                                }?> 
                            </tbody>
                        </table>
                        <input type='button' class='btn btn-success' id='botonExcel' value='Exportar a excel' onClick='enviar_tabla("TablaEmpresas")'/>
                        <input type='hidden' id='accion' name='accion' value='7' />
                        <input type='hidden' id='datos_a_enviar' name='datos_a_enviar' />
                    </div>
                </div>
            </form>
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
        </div>
        <div id="modalform"></div>
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