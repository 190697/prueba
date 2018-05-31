<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_index.php');
require_once('paises.php');
$usuarios = array("Prensa", "Invitados especiales", "Grupos artísticos", "Comité organizador del festival", "Técnicos", "Personal de apoyo");
$disciplinas = array();
$controlIndex = new ControladorIndex();
$consulta = $controlIndex->listarCotizaciones();
$lista_disciplinas = $controlIndex->indexDisciplinas();
if ($lista_disciplinas) {
    foreach ($lista_disciplinas as $row):
        $disciplinas[$row['idDisciplina']] = $row['nombre'];
    endforeach;
}

/* $consulta = $controlIndex->listarCotizaciones();
  $consulta2 = $controlIndex->listarCotizacionesSeguimiento(); */
?>
<head>
    <script src="js/grupo.js" type="text/javascript"></script>
</head>
<input type="hidden" id="formUrl" name="formUrl" value="home">
<div class="col-md-10 cont3">
    <div align="left" class="col-md-12">
        <input class="form-control" id="myInput" type="text" placeholder="Filtrar grupo por cualquier columna..">
    </div>
    <br><br>
    <div align="center" class="col-md-12">
        <a href=javascript:void(0) class="btn btn-success" data-value="vista/grupo/form_persona.php" onclick="modal(this)">
                <i class="fa fa-plus" aria-hidden="true"></i> Agregar anfitrion - grupo
            </a>
    </div>
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Tabla de grupos</div>
        <div class="panel-body">
            <div class="table table-responsive panelinicio">
                <?php
                if (!$consulta) {
                    echo '<div class="text-center" style="padding-top: 60px;"><h2><small>No existen registros almacenados</small></h2></div>';
                } else {
                    ?><!--
                                <div id="alertSeg" class="text-center alert-info" style="color:red;">
                                    <b><i class="fa fa-info-circle"></i> Click para finalizar seguimiento</b>
                                </div>-->
                    <table id="TablaCotizaciones" class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr class="info">
                                <th>Folio</th>
                                <th></th>
                                <th>Grupo</th>
                                <th>Anfitrion</th>
                                <th>Disciplina</th>
                                <th>Pais</th>
                                <th>Usuario</th>
                                <th>Personas</th>
                                <th>Clave</th>                                
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="TablaCotizacionFil">
                            <?php
                            foreach ($consulta as $row):
                                ?>
                                <tr> 
                                    <td><?= $row["folio"] ?></td>
                                    <td>
                                        <a href=javascript:void(0) data-value="vista/grupo/form_subfolios.php?idGrupo=<?= $row["idGrupo"] ?>&folio=<?= $row["folio"] ?>" onclick="modal(this)">
                                            <i class="fa fa-qrcode"></i>&nbsp;&nbsp;Subfolios
                                        </a>
                                    </td>
                                    <td><?= $row["nombre"] ?></td>
                                    <td><?= $row["antitrion"] ?></td>
                                    <td><?= $disciplinas[$row["disciplina"]] ?></td>
                                    <td><?= $paises[$row["pais"]] ?></td>
                                    <td><?= $usuarios[$row["categoria"]] ?></td>
                                    <td><?= $row["num_personas"] ?></td>
                                    <td><?= $row["clave"] ?></td>
                                    <td>
                                        <a href=javascript:void(0) data-value="vista/grupo/form_estancia.php?idGrupo=<?= $row["idGrupo"] ?>&folio=<?= $row["folio"] ?>" onclick="modal(this)">
                                            <i class="fa fa-building"></i>&nbsp;&nbsp;Estancia
                                        </a>
                                    </td>
                                    <td>
                                        <a href=javascript:void(0) id="<?= $row['idAnfitrion'] ?>" onClick="editarGrupo(this)">
                                            <i class="fa fa-edit"></i>&nbsp;&nbsp;Editar
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach ?>  
                        </tbody>
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
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 graficas">
    <div align="center">
        <img src="images/logo.png" style="width:70%"/>
        <img src="images/logo.jpg" style="width:70%"/>
    </div>
    <div id="pastel" style="display: none;"></div>
    <!--
    <div class="panel panel-primary">
        <div class="panel-heading">Panel with panel-primary class</div>
        <div class="panel-body">Hola mundo...vista/inicio<br><?= getcwd() . "\n"; ?></div>
    </div>
    -->
    <div id="pastel2" style="display: none;"></div>
    <div id="pastel3" style="display: none;"></div>
    <!--
    <div  id="pastel2" style="min-width: 250px; height: 273px; max-width: 600px; margin: 0 auto"></div>
    -->
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