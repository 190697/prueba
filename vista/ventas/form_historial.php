<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_venta.php');
require_once('../grupo/paises.php');
$idUsuario=0;
$usuarios=array("Prensa","Invitados especiales","Grupos artísticos","Comité organizador del festival","Técnicos","Personal de apoyo");
$disciplinas=array("Academia","Artes visuales","Artes Plásticas","Performance","Artes visuales","Música","Danza","Circo","Teatro","Sin definir");
if(isset($_POST["id"])){
    $idUsuario=$_POST["id"];
}
$controladorUsuario = new ControladorVenta();
$consulta = $controladorUsuario->historial($idUsuario);
?>
<!DOCTYPE html>
<!--Aqui va todo el contenido. <?php /* $_SERVER['DOCUMENT_ROOT'] . "/crm!" */ ?>-->
<head>
    <script src="js/venta.js" type="text/javascript"></script>
</head>
<div class="modal fade" id="modalAsignacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><font color="white">Historial de ventas</font></h4>
            </div>
            <div class="modal-body text-center">
                <input type="hidden" id="txtEditarUsuario" name="txtEditarUsuario" value="<?=$editar?>">
                <input type="hidden" id="txtIdTarjeta" name="txtIdTarjeta" value="0">
                <input type="hidden" id="txtDisponible" name="txtDisponible" value="0">
                <div class="form-group">
                    <?php
                    if (!$consulta) {
                        echo '<div class="text-center" style="padding-top: 60px;"><h2><small>No existen registros almacenados</small></h2></div>';
                    } else {
                        ?>
                        <form action='ajax/ajax_venta.php' method='post' target='_blank' id='FormularioExportacion'>
                            <input type="hidden" id="cat" value=""/>
                            <div id="graficaPregunta">
                                <div class='table-responsive text-left'>
                                    <table class='table table-hover' id='tablaCat' style='border: 1px solid black;'>
                                        <thead>
                                            <tr style='background:#2E86C1; color:#FDFEFE;'>
                                                <th><b>Nº</b></th>
                                                <th><b>Nombre</b></th>
                                                <th><b>Tipo usuario</b></th>
                                                <th><b>Pais</b></th>
                                                <th><b>Disciplina</b></th>
                                                <th><b>Servicio</b></th>
                                                <th><b>Detalle Servicio</b></th>
                                                <th><b>Subtotal</b></th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            $total=0;
                                            foreach ($consulta as $row):
                                                ?>
                                                <tr> 
                                                    <td><?=$i?></td>
                                                    <td><?=$row['nombre']?></td>
                                                    <td><?=$usuarios[$row['categoria']]?></td>
                                                    <td><?=$paises[$row['categoria']]?></td>
                                                    <td><?=$disciplinas[$row['categoria']]?></td>
                                                    <td><?=$row['servicio']?></td>
                                                    <td><?=$row['detalle']?></td>
                                                    <td>$<?= number_format($row['subtotal'],2);?></td>
                                                </tr>

                                            <?php 
                                            $total+=$row['subtotal'];
                                            $i++;
                                            endforeach; 
                                            ?>  
                                                <tr></tr>
                                                <tr>
                                                    <td colspan="8"><b>Total:</b>&nbsp;&nbsp;$<?=number_format($total,2)?></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <input type='button' class='btn btn-success' id='botonExcel' value='Exportar a excel' onClick='enviar_tabla()'/>
                                    <input type='hidden' id='accion' name='accion' value='3' />
                                    <input type='hidden' id='datos_a_enviar' name='datos_a_enviar' />
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modalAsignacion").modal();
    $("#error4").hide();
    $("#txtTarjeta").focus();
    $("#txtTarjeta").focus(function (){
        swal({
            title: "Tarjeta!",
            text: "Debe de escanear alguna tajeta.",
            type: "info",
            timer: 2000,
            showConfirmButton: false,
        });
    });
    function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==13){
                buscarUsuario();
                $("#txtNip").focus();
            }else{
                $("#error1").hide(500);
                $("#error2").hide(500);
                $("#error3").hide(500);
            }
        }
</script>