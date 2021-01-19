<?php

if (!isset($_POST["curp"])) {
    header("Location: ../");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$semestre = $_POST["semestre"];
$id_programa_academico = $_POST["programaacad"];
$opcion = $_POST["opcion"];

$query = "UPDATE Alumno_has_programa SET semestre = '$semestre', id_programa_academico = $id_programa_academico, opcion = $opcion WHERE curp_alumno = '$curp'";
$result = mysqli_query($link, $query);

if ($result)
    echo "true";
else
    echo "false";

mysqli_close($link);

?>