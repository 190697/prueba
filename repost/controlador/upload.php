<?php

//comprobamos que sea una petición ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $texto = rand(1, 999);
    $DesdeLetra = "a";
    $HastaLetra = "z";
    $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
    $file = $texto . $_FILES['archivo']['name'];
    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if (!is_dir("../files/"))
        mkdir("../files/", 0777);
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "../files/" . $file)) {
        echo $file; //devolvemos el nombre del archivo para pintar la imagen
    }
    //obtenemos el archivo a subir
} else {
    throw new Exception("Error Processing Request", 1);
}