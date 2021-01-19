<?php

session_start();

include '../php/db.php';
$link = open_database();

$usuario = $_POST["usuario"];
$contra = $_POST["contrasena"];

$query = "SELECT id FROM admin WHERE usuario = '$usuario' AND contrasena = '$contra'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) == 0) {
    $query = "SELECT id FROM admin WHERE usuario = '$usuario' AND contrasena = '" . md5($contra) . "'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0)
        echo "false";
    else {
        echo "true";
        $_SESSION["id"] = mysqli_fetch_array($result)[0];
    }
}
else {
    echo "true";
    $_SESSION["id"] = mysqli_fetch_array($result)[0];
}

mysqli_close($link);

?>