<?php

if (!isset($_POST["curp"])) {
    header("Location: ../");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$query = "DELETE FROM Alumno WHERE curp = '$curp'";
$result = mysqli_query($link, $query);

if ($result)
    echo "true";
else
    echo "El alumno no se pudo eliminar, inténtelo más tarde";

mysqli_close($link);

?>