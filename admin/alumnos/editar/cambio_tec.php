<?php

if (!isset($_POST["curp"])) {
    header("Location: ../");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$id_escuela = $_POST["escuela"];
$promedio = $_POST["promedio"];
$query = "SELECT id_formacion_tecnica FROM formacion_tecnica WHERE nombre = '" . $_POST['formacion'] . "'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) == 0) {
    echo "false[#4]: Error al tratar de obtener el id de la formacion tecnica, parece que no existe";
    exit;
}
$id_formacion_tecnica = mysqli_fetch_array($result)[0];

$query = "UPDATE Alumno_has_escuela SET id_escuela = $id_escuela, id_formacion_tecnica = $id_formacion_tecnica, promedio = $promedio WHERE curp_alumno = '$curp'";
$result = mysqli_query($link, $query);

if ($result)
    echo "true[#4]";
else
    echo "false[#4]: Error al tratar de actualizar la información de la escuela de procedencia del alumno ($curp)";

mysqli_close($link);

?>