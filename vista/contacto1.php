<?php

$message  = "<html>
<head>
 <style type='text/css'>
  .btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 15px 25px 15px 25px;
  text-decoration: none;
}

.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
</style>
</head>
<body>
<div align='center'>
<img src='http://www.guanajuatosisabe.com/images/cervantinog/HeadHome2.jpg' width='800' height='100' alt='Logotipo de HTML5'>
  <form name='form1' action='http://www.yahoo.es' target='_blank' method='post'>
    <h1>Activar tarjeta</h1>
<h3>Guanajuato - activación de tarjetas</h3>
    <input type='submit' value='Activar ahora' class='btn'>
  </form>
</div>
</body></html>";
//Titulo
$titulo = "PRUEBA DE TITULO";
//cabecera
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//dirección del remitente 
$headers .= "From: prueba <nada>\r\n";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail("christiam.jmv1906@gmail.com",$titulo,$message,$headers);
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
?>