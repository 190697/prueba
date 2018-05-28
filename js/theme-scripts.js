$(function () {
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});

// hide #back-top first
$("#back-top").hide();

// fade in #back-top

$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('#back-top').fadeIn();
    } else {
        $('#back-top').fadeOut();
    }
});

// scroll body to 0px on click
$('#back-top a').on("click", function () {
    $('body,html').animate({
        scrollTop: 0
    }, 800);
    return false;
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function () {
    $('.navbar-toggle:visible').click();
});

//----------------------Cerrar sesion--------------
function cerrarSesion() {
    var URLactual = window.location;
    var url = "./ajax/ajax_inicio.php";
    if (URLactual == "http://localhost/crm/index.php#" || URLactual == "http://localhost/crm/index.php") {
        url = "./ajax/ajax_inicio.php";
    }
    $.ajax({
        url: url,
        type: 'post',
        data: {accion: 5},
        success: function (response) {
            if (response != 1) {
                swal("Error!", "Error al intentar cerrar sesión.", "warning");
            } else {
                location.reload();
            }
            return false;
        }
    });
}
$(function () {
    $('.cerrar').click(function () {
        cerrarSesion();
    });
});

function sideBar() {
    $("#sidebar").toggleClass("active");
    $(this).toggleClass("active");
}

function navContent(nombre) {
    $destino = "vista/"+nombre+".php";
    $.post($destino)
            .done(function (data) {
                $("#content").html(data);
            });
}