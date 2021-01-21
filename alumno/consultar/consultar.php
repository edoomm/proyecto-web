<?php

include '../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];
$contra = $_POST["contra"];

$query = "SELECT * FROM Alumno WHERE curp = '$curp' AND contrasena = '" . md5($contra) . "'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0)
    echo "false";
else 
    echo json_encode(mysqli_fetch_array($result));

mysqli_close($link);

?>