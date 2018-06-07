function login () {
        var usuario = $("#usrname").val();
        var contra = $("#psw").val();
        if (usuario.length<1) {
            $("#error1").slideDown(500);
        } else {
            $("#error1").hide(500);
        }
        if (contra.length<1) {
            $("#error2").slideDown(500);
        } else {
            $("#error2").hide(500);
        }
        if (usuario.length>2 && contra.length>2) {
            var url = "../ajax/ajax_inicio.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#formulario").serialize(),
                success: function (data)
                {
                    if (data==1) {
                        $("#error3").slideDown(500);
                    }else{
                        window.location.replace('../index'); 
                    }
                }
            });
        }
    }
    
    function consultarSaldo () {
        var tarjeta = $("#txtTarjeta").val();
        var nip = $("#txtNip").val();
        if (tarjeta.length<10) {
            $("#error4").slideDown(500);
        } else {
            $("#error4").hide(500);
        }
        if (nip.length<4) {
            $("#error5").slideDown(500);
        } else {
            $("#error5").hide(500);
        }
        if (tarjeta.length>=10 && nip.length>3) {
            var url = "../ajax/ajax_inicio.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#formulario2").serialize(),
                success: function (data)
                {
                    var datos = JSON.parse(data);
                    if (datos.estado==1) {
                        $("#error6").slideDown(500);
                    }else{
                        $("#error6").hide(500);
                        swal({
                            html:true,
                            title: "<i>Consulta de saldo!</i>", 
                            text: "<h3>"+datos.result[0]['nombre']+"</h3>"+
                                "<b>Saldo asignado</b><br>$"+parseFloat(datos.result[0]['monto']).toFixed(2)+
                                "<br><b>Saldo disponible</b><br>$"+parseFloat(datos.result[0]['disponible']).toFixed(2),  
                            type: 'info',
                          });
                        $("#txtTarjeta").val("");
                        $("#txtNip").val("");
                    }
                }
            });
        }
    }
   
function consultar() {
    $("#error4").hide();
    $("#error5").hide();
    $("#error6").hide();
    $("#formulario").hide(500);
    $("#formulario2").show(500);
    $("#login").hide(500);
    $("#checar").show(500);
}

function verlogin() {
    $("#formulario").show(500);
    $("#formulario2").hide(500);
    $("#checar").hide(500);
    $("#login").show(500);
    $("#error1").hide();
    $("#error2").hide();
    $("#error3").hide();
}