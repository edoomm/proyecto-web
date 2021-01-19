<?php

if (!isset($_POST["clave"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$clave = $_POST["clave"];
$horario = $_POST["horario"];
$cupo = $_POST["cupo"];

$query = "INSERT INTO Grupo (clave, horario, cupo) VALUE ('$clave', '$horario', $cupo)";
$result = mysqli_query($link, $query);

if ($result)
    echo "Grupo creado correctamente";
else
    echo "Ocurrió un fallo al tratar de crear el grupo";

mysqli_close($link);

?>