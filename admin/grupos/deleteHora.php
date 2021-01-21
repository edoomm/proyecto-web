<?php

if (!isset($_POST["hora"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$hora = $_POST["hora"];

$query = "DELETE FROM Horario WHERE hora = '$hora'";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "No se pudo eliminar el hora, intentelo más tarde";
}

mysqli_close($link);

?>