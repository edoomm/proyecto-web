<?php

if (!isset($_POST["curp"])) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = '';
    header("Location: http://$host$uri/$extra");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$nombre_escuela = $_POST["nombre_escuela"];
$promedio = $_POST["promedio"];
$localidad = $_POST["localidad"];
$tipo = $_POST["tipo"];

// verificando si ya hay una escuela con el mismo nombre
$query = "SELECT id_escuela FROM Escuela WHERE nombre = '$nombre_escuela' AND tipo = '$tipo'";
$result = mysqli_query($link, $query);
// si no existe la creamos
if (mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO Escuela (nombre, localidad, tipo) VALUE ('$nombre_escuela', '$localidad', '$tipo')";
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo "false [#4]: Error al crear la nueva escuela";
        exit;
    }
}
// obteniendo ID
$query = "SELECT id_escuela FROM Escuela WHERE nombre = '$nombre_escuela' AND tipo = '$tipo' ORDER BY id_escuela DESC LIMIT 1";
$result = mysqli_query($link, $query);
$id_escuela = mysqli_fetch_array($result)[0];
if (mysqli_num_rows($result) == 0) {
    echo "false [#4]: Error al obtener id_escuela";
    exit;
}

//update
$query = "UPDATE Alumno_has_escuela SET id_escuela = $id_escuela, id_formacion_tecnica = NULL, promedio = $promedio WHERE curp_alumno = '$curp'";
$result = mysqli_query($link, $query);
if ($result)
    echo "true [#4]";
else
    echo "false [#4]";

mysqli_close($link);

?>