<?php

$username = trim($_POST['uname']);
$password = trim($_POST['psw']);

if (!strlen($username) || !strlen($password)) {
    die('Please enter a username and password');
}

$success = false;

$handle = fopen("../practica1/registros.csv", "r");

while (($data = fgetcsv($handle)) !== FALSE) {
    if ($data[0] == $username && $data[1] == sha1($password)) {
        $success = true;
        break;
    }
}

fclose($handle);

if ($success) {
    echo "Felicidades, Has iniciado sesion";
    echo "<div class='container'>
        <p>¿Terminaste? <a href='../practica1/index.php'>Regresar a inicio</a>.</p>
        </div>";
} else {
    echo "Lo sentimos, Tu registro no se encuentra en la base de datos";
    echo "<div class='container'>
        <p>¿Terminaste? <a href='../practica1/index.php'>Regresar a inicio</a>.</p>
        </div>";
}?>