<?php
require $_SERVER['DOCUMENT_ROOT'] . '/sectur/correo/PHPMailerAutoload.php';
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

    function enviar($correo,$contra) {
$mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPSecure = "";
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'robert15001561@gmail.com';
                    $mail->Password = '15001561';

                    $mail->setFrom('FIC','FIC');
                    $mail->addAddress($correo);
                    $mail->Subject = 'Acceso a plataforma FIC';
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
			<img style="padding: 0; display: block" src="https://www.dirac.gob.cl/prontus_dirac/site/artic/20121003/imag/foto_0000000220121003123232.png" width="100%" height="30%">
		</td>
	</tr>
	
	<tr>
		<td style="background-color: white">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px">Acceso a plataforma FIC</h2>
			<div>
				<img style="padding: 0; width: 25px; margin: 0px" align="left" src="https://cdn.icon-icons.com/icons2/827/PNG/512/user_icon-icons.com_66546.png">
				<p style="margin: 2px; font-size: 20px">&nbsp;&nbsp;Usuario: '.$correo.'</p>
				</div><br>
				<div>
				<img style="padding: 0; width: 27px; margin: 0px" align="left" src="http://www.crxcarbonbank.com/img/logos/reset-password.png">
				<p style="margin: 2px; font-size: 20px">&nbsp;&nbsp;Clave de acceso: '.$contra.'</p>
				</div><br><br>
				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="metaconsultec.com/sectur/">Ir a plataforma</a>	
				</div>
				<div style="width: 100%;margin:20px 0; display: inline-block;text-align: center">
					<img style="padding: 0; width: 50px; margin: 5px" src="https://images.vexels.com/media/users/3/137253/isolated/preview/90dd9f12fdd1eefb8c8976903944c026-icono-de-icono-de-facebook-by-vexels.png">
					<img style="padding: 0; width: 50px; margin: 5px" src="http://pngimg.com/uploads/gmail_logo/gmail_logo_PNG8.png">
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Festival internacional Cervantino 2018</p>
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
