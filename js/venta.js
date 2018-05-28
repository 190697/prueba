function enviar_tabla() {
    $("#datos_a_enviar").val($("<div>").append($("#tablaCat").eq(0).clone()).html());
    $("#FormularioExportacion").submit();
}

function buscarUsuario(){
    var tarjeta = $("#txtTarjeta").val();
    if (tarjeta.length<10) {
        $("#error4").slideDown(500);
    } else {
        $("#error4").hide(500);
    }
    if (tarjeta.length>=10) {
        var url = "./ajax/ajax_venta.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {accion:1, idTarjeta:tarjeta},
            success: function (data)
            {
                var datos = JSON.parse(data);
                if (datos.estado==1) {
                    swal("Error!","No se encontraron resultados\nVerifique que su tarjeta este activa","error");
                    $("#txtTarjeta").val("");
                }else{
                    $("#error6").hide(500);
                    $("#fromVenta").show(500);
                    $("#txtMonto").val(parseFloat(datos.result[0]['disponible']).toFixed(2));
                    $("#txtDisponible").val(datos.result[0]['disponible']);
                    $("#txtIdTarjeta").val(datos.result[0]['idTarjeta']);
                    $("#txtNombre").val(datos.result[0]['nombre']);
                    $('#dropCatUsuario > option[value="'+datos.result[0]['categoria']+'"]').attr('selected', 'selected');
                    $('#dropPaisUsuario > option[value="'+datos.result[0]['pais']+'"]').attr('selected', 'selected');
                    $('#dropDisUsuario > option[value="'+datos.result[0]['disciplina']+'"]').attr('selected', 'selected');
                }
            }
        });
    }
}

function insertarVenta(){
    $total=0;
    $disponible=0;
    $idTarjeta=$("#txtIdTarjeta").val();
    $servicio=$("#txtServicio").val();
    $detalle=$("#txtDetalleServicio").val();
    $total=$("#txtTotal").val();
    $disponible=$("#txtDisponible").val();
    var url = "./ajax/ajax_venta.php";
    if($total > $disponible){
        swal("Error!","El monto disponible no cubre la compra","error");
    }else{
        swal({
        title: "IMPORATANTE!",
        text: "Ingrese su NIP",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "****"
      }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
          swal.showInputError("You need to write something!");
          return false
        }
        $nip=inputValue;
        $.ajax({
            type: "POST",
            url: url,
            data: {accion:2, idTarjeta:$idTarjeta, servicio:$servicio, detalle:$detalle, total:$total, nip:$nip},
            success: function (data)
            {
                var datos = JSON.parse(data);
                if (datos.estado==0) {
                    swal("No se encontraron resultados!","Verifique su NIP y que su tarjeta este activa","error");
                    $("#txtTarjeta").val("");
                }else{
                    $(".cancel").click();
                    $("#modalAsignacion").modal('toggle');
                    $("#ventasid").click();
                    swal("Exito!","Se ha registrado correctamente la venta","success");
                }
            }
        });
      });
    }
}