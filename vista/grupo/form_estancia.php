<?php if (isset($_GET["idGrupo"])) { 
     include ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_index.php');
     include ($_SERVER['DOCUMENT_ROOT'] . '/sectur/vista/grupo/paises.php');
    $controlIndex = new ControladorIndex();
    $image="";
    $idGrupo=$_GET["idGrupo"];
    $consulta = $controlIndex->indexSubfolios($idGrupo);
    $consulta2 = $controlIndex->indexHospedaje($idGrupo);
    $lista_hoteles = $controlIndex->indexHoteles();
    ?>
    <head>
        <script src="js/grupo.js" type="text/javascript"></script>
    </head>
    <div class="modal fade" id="modalCotizacion" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><font color="white">Estancia por grupo</font></h4>
                </div>
                <div class="modal-body text-center"> 
                    <input type="hidden" id="actualizarCot" name="actualizarCot" value="<?= $_GET["idCoti"] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 form-group">
                                <b>Folio de grupo: <?=$_GET["folio"]?></b>
                                <select class="form-control" id="dropSubfolio">
                                    <option value=0>Selecciona el subfolio..</option>
                                    <?php
                                    $i=0;   
                                    foreach ($consulta as $row):
                                        ?>
                                    <option value="<?=$row["idSubgrupo"]?>"><?=$row["subFolio"]?></option>
                                    <?php 
                                    endforeach ;
                                    ?> 
                                </select>
                            </div>
                            <?php
                            if(!$consulta){?>
                            <div align="center"><h2><small>No existen registros almacenados</small></h2></div>
                            <?php
                            }else{?>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <b>Fecha de entrada</b>
                                    <input type="date" class="form-control" id="fechaEntrada" placeholder="Ejemplo 2018-01-25">
                                </div>
                                <div class="form-group">
                                    <b>Hotel</b>
                                    <select class="form-control" id="dropHotel" name="dropHotel" onchange='recargarHabitaciones()'>
                                        <option value=>Selecciona el hotel..</option>
                                        <?php
                                        foreach ($lista_hoteles as $row):
                                            $hoteles[$row['idHotel']]=$row['nombre'];
                                            if($row['estatus']!=0){?>
                                                <option value="<?=$row['idHotel']?>"><?=$row['nombre']?></option>
                                            <?php
                                            }
                                            ?>
                                        <?php 
                                        endforeach ?> 
                                    </select>
                                </div>
                                    <!--
                                <div class="form-group">
                                    <b>Tarifa</b>
                                    <input type="number" class="form-control" id="txtTarifa" placeholder="0.00" value="" min="1">
                                </div>-->                                    
                                    <div class="form-group" id="divHab" style="display: none;">
                                    <b>Tipo de habitaciones:</b>
                                    <select class="form-control" id="dropHabitacion" name="dropHabitacion">
                                        <option value=0>Selecciona la habitacion..</option>
                                        <?php
                                        $i=0;   
                                        foreach ($habitaciones as $row):
                                            ?>
                                        <option value="<?=$i?>"><?=$row?></option>
                                        <?php 
                                        $i++;
                                        endforeach ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--
                                <div class="form-group">
                                    <b>Fecha de salida</b>
                                    <input type="date" class="form-control" id="fechaSalida" placeholder="Ejemplo 2018-01-25">
                                </div>
                                -->
                                <div class="form-group">
                                    <b>Numero de habitaciones</b>
                                    <input type="number" class="form-control" id="txtHabitaciones" placeholder="1" value="" min="1">
                                </div>
                                <div class="form-group">
                                    <b>Numero de noches</b>
                                    <input type="number" class="form-control" id="txtNoches" placeholder="1" value="" min="1">
                                </div>
                                <div class="form-group">
                                    <b>Total</b>
                                    <input type="number" class="form-control" id="txtTotal" placeholder="0" value="" disabled min="1">
                                </div>
                            </div>
                            <div class="col-md-12" align="center">
                                <br>
                                <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="ingresarEstancia()"><i class="fa fa-save"></i> Registrara estancia</button>
                            </div>
                            <?php
                            }?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group table-responsive">
                        <?php
                        if($consulta){
                            if (!$consulta2) {
                                echo '<div class="text-center" style="padding-botom: 30px;"><h2><small>No existen estancias registradas</small></h2></div>';
                            } else {
                            ?>
                                <table id="tabSubfolio" class="table table-condensed table-hover table-striped">
                                    <thead>
                                        <tr class="alert-info">
                                            <th>Nº</th>
                                            <th>SubFolio</th>
                                            <th>Entrada</th>
                                            <th>Salida</th>
                                            <th>Hotel</th>
                                            <th>Tarifa</th>
                                            <th>Habitaciones</th>
                                            <th>Noches</th>
                                            <th>Habitacion</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1;   
                                        foreach ($consulta2 as $row):
                                            ?>
                                        <tr> 
                                            <td><?=$i?></td>
                                            <td><?=$row["folioSubGrupo"]?></td>
                                            <td><?=$row["fechaEntrada"]?></td>
                                            <td><?=$row["fechaSalida"]?></td>
                                            <td><?=$hoteles[$row["hotel"]]?></td>
                                            <td><?=$row["tarifa"]?></td>
                                            <td><?=$row["num_habitaciones"]?></td>
                                            <td><?=$row["num_noches"]?></td>
                                            <td><?=$habitaciones[$row["tipo_habitacion"]]?></td>
                                            <td><?=$row["total"]?></td>
                                        </tr>

                                        <?php 
                                        $i++;
                                        endforeach ?>  
                                    </tbody>
                            </table>
                            <?php 
                            }
                        }
                        ?>
                    </div>
                </div>
                <div id="xmail2" class="hide text-center"><h5 class="text-danger">Seleccione una opción</h5></div>
            </div>
        </div>
    </div>
    <script>
        $("#modalCotizacion").modal();
    </script>

    <?php
}
?>