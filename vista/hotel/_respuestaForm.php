<?php if (isset($_GET["id"])) { 
    $aceptada="";
    $rechazada="";
    if($_GET["estatus"]==2)$aceptada="checked";
    if($_GET["estatus"]==3)$rechazada="checked";
    ?>
    <div class="modal fade" id="modalCotizacion" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><font color="white">Respuesta de solicitud</font></h4>
                </div>
                <div class="modal-body text-center"> 
                    <input type="hidden" id="actualizarEstancia" name="actualizarEstancia" value="<?= $_GET["id"] ?>">
                    <div class="form-group">
                        <b>Selecciona una opción</b><br>
                        <input type="radio" id="estado" name="gender" value="2" <?=$aceptada?>> <span style="color: #28B463;">Aceptada <i class='fa fa-check' aria-hidden=true></i></span>&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="estado" name="gender" value="3" <?=$rechazada?>> <span style="color: #FF0000;">Rechazada <i class='fa fa-times' aria-hidden=true></i></span>
                    </div>
                </div>
                <div id="xmail2" class="hide text-center"><h5 class="text-danger">Seleccione una opción</h5></div>
                <div class="modal-footer">
                    <button class="btn btn-info" id="guardarGiro" name="guardarGiro" onclick="respuesta()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#modalCotizacion").modal();
    </script>

    <?php
}
?>