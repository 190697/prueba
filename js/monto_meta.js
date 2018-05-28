function insertarMonto() {
    $monto = $("#txtMontoMeta").val();
    num=$monto;
    var url = "./ajax/ajax_meta.php";
    if ($monto < 1) {
        swal("Error!", "Se debe de llenar todos los campos.", "warning");
    } else {
        $.ajax({
            url: url,
            type: 'post',
            data: {accion: 1, monto: $monto},
            success: function (response) {
                var datos = JSON.parse(response);
                if (datos.estado != 0) {
                    swal({
                        title: "Exito!",
                        text: "Se ha registrado correctamente.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $(".close").click();
                    setTimeout(function(){
                        $("#amonto").click();
                        $("#monto_meta").empty();
                        $("#monto_meta").text("M/actual: "+num+".00");
                    },500);
                } else {
                    swal("Error!", "Error al intentar crear el registro.", "warning");
                }
            }
        });
    }

}

//Validar numeros
$(document).ready(function () {
    $('#txtMontoMeta').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});