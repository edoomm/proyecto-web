<?php

if (!isset($_POST["clave"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$clave = $_POST["clave"];

$query = "SELECT * FROM Alumno_has_grupo WHERE clave_grupo = '$clave'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    echo "El grupo no puede ser eliminado ya que contiene alumnos inscritos a él.\nSi desea eliminarlo tendrá que cambiar los alumnos inscritos a él a otro grupo.\nNo olviden notificar a dichos alumnos del cambio de grupo.";
    mysqli_close($link);
    exit;
}

$query = "DELETE FROM Grupo WHERE clave = '$clave'";
$result = mysqli_query($link, $query);

if ($result)
    echo "true";
else
    echo "El grupo no se pudo eliminar, inténtelo más tarde";

mysqli_close($link);

?>