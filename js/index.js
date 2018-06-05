function mostrarIndex(index) {
    $destino = "vista/layout/sideBar.php";
    $.post($destino)
            .done(function (data) {
                $("#sidebar").html(data);
            });
    $destino = "vista/layout/navBar.php";
    $.post($destino)
            .done(function (data) {
                $("#nav").html(data);
            });
    $destino = "vista/inicio.php";
    if(index==1){
        $destino = "vista/ventas/venta.php";
    }else if(index==2){
        $destino = "vista/grupo/grupos.php";
    }
    $.post($destino)
            .done(function (data) {
                $("#content").html(data);
            });
}

function modal(boton) {
    $destino = boton.dataset.value;
    $("#modal").empty();
    $.post($destino)
            .done(function (data) {
                $("#modal").html(data);
            });
}

function editarCotizacion(boton) {
    var i = boton.parentNode.parentNode.rowIndex;
    $idCliente = boton.id;
    $destino = "vista/cotizacion/form_cotizacion.php";
    modal2($destino, $idCliente, i);
}

function seguimiento($id) {
    $destino = "vista/cotizacion/form_seguimiento.php?idCoti="+$id;
    $("#modal").empty();
    $.post($destino)
            .done(function (data) {
                $("#modal").html(data);
            });
}

function recargarDrop(){
    
}

function recargarGraficas() {
    var url = "ajax/ajax_inicio.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {accion: 1},
        success: function (response)
        {
            var datos = JSON.parse(response);
            if (datos.estado == 1) {
                var data = [];
                for (var i = 0; i < datos.result.length; i++) {
                    var serie = new Array(datos.result[i].prueba, parseInt(datos.result[i].numero));
                    //console.log("Datos:"+datos.result[i].nombre+"Num:"+parseInt(datos.result[i].numero));
                    data.push(serie);
                }
                pastel(data, "Contacto diario...", "pastel");
            }
        }
    });
    $.ajax({
        type: "POST",
        url: url,
        data: {accion: 2},
        success: function (response)
        {
            var datos = JSON.parse(response);
            if (datos.estado == 1) {
                var data = [];
                for (var i = 0; i < datos.result.length; i++) {
                    var serie = new Array(datos.result[i].prueba, parseInt(datos.result[i].numero));
                    //console.log("Datos:"+datos.result[i].nombre+"Num:"+parseInt(datos.result[i].numero));
                    data.push(serie);
                }
                pastel(data, "Contacto semanal...", "pastel2");
            }
        }
    });
    $.ajax({
        type: "POST",
        url: url,
        data: {accion: 3},
        success: function (response)
        {
            var datos = JSON.parse(response);
            if (datos.estado == 1) {
                var data = [];
                for (var i = 0; i < datos.result.length; i++) {
                    var serie = new Array(datos.result[i].prueba, parseInt(datos.result[i].numero));
                    //console.log("Datos:"+datos.result[i].nombre+"Num:"+parseInt(datos.result[i].numero));
                    data.push(serie);
                }
                pastel(data, "Contacto mensual...", "pastel3");
            }
        }
    });
}

function pastel(series, nombre, container) {
    Highcharts.chart(container, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1, //null,
            plotShadow: false
        },
        title: {
            text: '<b>' + nombre + '</b>',
        },
        tooltip: {
            pointFormat: 'Total:<b>{point.y}</b><br>Procentaje: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '<b>{point.name}</b>: {point.y}',
                    //format: '{point.name}: <b>{point.percentage:.1f}%</b>',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                    }
                },
                showInLegend: true
            }
        },
        series: [{
                type: 'pie',
                data: series
            }]
    });
}