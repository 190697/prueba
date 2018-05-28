<?php
/*include('../controlador/controlador_encuesta.php');
header("Content-Type: text/html;charset=utf-8");
$controlador = new ControladorEncuesta();
$e_encuesta = $controlador->consultarEncuestas();*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>SRA | Inicio</title>
        <link href="../librerias/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../librerias/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="../librerias/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="../librerias/jquery-1.10.2.js" ></script>
        <script src="../librerias/bootstrap/js/bootstrap.js"></script>
        <link href="../images/icono.png" rel='shortcut icon' type='image/png'>
        <script src="../librerias/sweetalert.min.js"></script>
        <script src="../js/login.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../librerias/sweetalert.css">
        <link rel="stylesheet" type="text/css" href="../librerias/facebook.css">
    </head>
    <style>
        #formulario2{
            display: none;
        }
        #checar{
            display: none;
        }
        .modal-header, h4, .close {
            background-color: #196193;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-footer {
            background-color: #f9f9f9;
        }
        
        #button{
            background-color: #196193;
            border-color: #2E86C1!important;
            color:white !important;
            text-align: center;
            font-size: 18px;
        }
        
        .button{
            background-color: #196193;
            border-color: #2E86C1!important;
            color:white !important;
            text-align: center;
            font-size: 18px;
        }
        
        .error{
            color:red !important;
            text-align: center;
            font-size: 12px;
        }
    </style>
    <body class="login">
        <!-- Modal -->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <h4 id="login"><span class="glyphicon glyphicon-lock"></span> Iniciar sesión</h4>
                        <h4 id="checar"><span class="fa fa-search"></span> Consultar saldo</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" id="formulario">
                            <input type="hidden" id="accion" name="accion" value="4"/>
                            <div class="form-group">
                                <label for="usrname"><span class="glyphicon glyphicon-user"></span> Usuario</label>
                                <input type="text" class="form-control" id="usrname" name="usrname" onkeypress="validar(event)" placeholder="Ingresa tu nombre de usuario">
                                <label id="error1" class="error">Ingrese el nombre de usuario</label>
                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
                                <input type="password" class="form-control" id="psw" name="psw" onkeypress="validar(event)" placeholder="Ingresa tu contraseña">
                                <label id="error2" class="error">Ingrese la contraseña</label>
                            </div>
                            <div align="center">
                                <button type="button" id="button" class="btn btn-success btn-block" onclick="login()"><span class="glyphicon glyphicon-off"></span> Acceder</button>
                            <label id="error3" class="error">Usuario y/o contraseña incorrectos</label>
                            </div>
                            <div align="right">
                                <a href="#" onclick="consultar()"><span class="glyphicon glyphicon-eye-open"></span> Consultar saldo actual disponible</a>
                            </div>
                        </form>
                        <form role="form" id="formulario2">
                            <input type="hidden" id="accion" name="accion" value="6"/>
                            <div class="form-group">
                                <label for="usrname"><span class="fa fa-tag"></span> Tarjeta</label>
                                <input type="text" class="form-control" id="txtTarjeta" name="txtTarjeta" placeholder="Escanear tarjeta" maxlength="10">
                                <label id="error4" class="error">Debe escanear su tarjeta</label>
                            </div>
                            <div class="form-group">
                                <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> NIP</label>
                                <input type="password" class="form-control" id="txtNip" name="txtNip" placeholder="NIP" maxlength="4">
                                <label id="error5" class="error">Ingrese el nip</label>
                            </div>
                            <div align="center">
                                <button type="button" class="btn btn-success btn-block button" onclick="consultarSaldo()"> Consultar</button>
                            <label id="error6" class="error">Tarjeta y/o NIP incorrectos</label>
                            </div>
                            <div align="right" id="divlogin">
                                <a href="javascript:void(0)" onclick="verlogin()"><span class="glyphicon glyphicon-user"></span> Iniciar Sesión</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div> 
        <footer>
            <div class="container text-center">
                <p>Sitio creado por <a href="http://metaconsultec.com/"><span>METACONSULTEC SC</span></a> 2018</p>
            </div>
        </footer>
    <script>
        $("#myModal").modal("show");
        $("#error1").hide();
        $("#error2").hide();
        $("#error3").hide();
        
        function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==13){
                login();
            }else{
                $("#error1").hide(500);
                $("#error2").hide(500);
                $("#error3").hide(500);
            }
        }
    </script>
   </body>
</html>