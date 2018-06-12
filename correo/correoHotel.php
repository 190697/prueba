<?php
require $_SERVER['DOCUMENT_ROOT'] . '/sectur/correo/PHPMailerAutoload.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/sectur/controlador/controlador_hotel.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of correo
 *
 * @author Metaconsultec
 */
class correo {

    function enviar($idEstancia) {
        $controlHoteles = new ControladorHotel();
        $consulta1 = $controlHoteles->buscarEstancia($idEstancia);
        $estatus="<font color='green'>Aceptada</font>";
        if($consulta1[0]["estatus"]==3)$estatus="<font color='red'>Rechazada</font>";
    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPSecure = "";
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'robert15001561@gmail.com';
                    $mail->Password = '15001561';

                    $mail->setFrom('christiam.jmv1906@gmail.com', 'christiam.jmv1906@gmail.com');
                    $mail->addAddress('christiam.jmv1906@gmail.com');
                    $mail->Subject = 'SMTP email test';
                    $mail->IsHTML(true);
                    $mail->Body = '
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body style="background-color: white ">

<!--Copia desde aquí-->
<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr>
		<td style="background-color: white; text-align: left; padding: 0">
			<a href="">
				<img width="20%" style="display:block; margin: 1.5% 3%" src="https://seeklogo.com/images/G/guanajuato-secretaria-de-educacion-2013-logo-2257F9F4A6-seeklogo.com.png">
			</a>
		</td>
	</tr>
	<tr>
		<td style="padding: 0">
			<img style="padding: 0; display: block" src="http://www.mexicoescultura.com/galerias/actividades/principal/mexico_es_cultura_cervantino.png" width="100%" height="30%">
		</td>
	</tr>
	
	<tr>
		<td style="background-color: white">
                    <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                            <h2 style="color: #e67e22; margin: 0 0 7px">Respuesta Hotel "'.$consulta1[0]["hotel"].'"</h2>
                            <h3 style="margin: 0 0 7px">Detalles de solicitud: '.$estatus.'</h3>
                        <div>
                            <p style="color:black!important;margin: 2px; font-size: 20px">
                                &nbsp;&nbsp;Grupo: '.$consulta1[0]["nombre"].'<br>
                                &nbsp;&nbsp;Clave: '.$consulta1[0]["clave"].'<br>
                                &nbsp;&nbsp;Folio: '.$consulta1[0]["folio"].'<br>
                                &nbsp;&nbsp;Subfolio: '.$consulta1[0]["subfolio"].'<br>
                                &nbsp;&nbsp;Fecha entrada: '.$consulta1[0]["fechaEntrada"].'<br>
                                &nbsp;&nbsp;Num habitaciones: '.$consulta1[0]["num_habitaciones"].'<br>
                                &nbsp;&nbsp;Num noches: '.$consulta1[0]["num_noches"].'<br>
                                &nbsp;&nbsp;Habitación: '.$consulta1[0]["habitacion"].'<br>
                                &nbsp;&nbsp;Tarifa: $'. number_format($consulta1[0]["costo"],2).'<br>
                                &nbsp;&nbsp;Total: $'. number_format($consulta1[0]["total"],2).'<br>
                            </p>
                        </div><br>
                        <div><br><br>
                            <div style="width: 100%; text-align: center">
                                    <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="metaconsultec.com/sectur/">Ir a plataforma</a>	
                            </div>
                            <div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
                                    <img style="padding: 0; width: 50px; margin: 5px" src="https://images.vexels.com/media/users/3/137253/isolated/preview/90dd9f12fdd1eefb8c8976903944c026-icono-de-icono-de-facebook-by-vexels.png">
                                    <img style="padding: 0; width: 50px; margin: 5px" src="http://pngimg.com/uploads/gmail_logo/gmail_logo_PNG8.png">
                            </div>
                            <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Festival internacional Cervantino 2018</p>
                        </div>
                    </div>
		</td>
	</tr>
</table>
<!--hasta aquí-->

</body>
</html>';
                    if ($mail->send()){
                        return true;
                    }
   
    }

}
