<?php

if (!isset($_POST["fecha"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$fecha = $_POST["fecha"];

$query = "DELETE FROM Dia WHERE fecha = '$fecha'";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "No se pudo eliminar el día, intentelo más tarde";
}

mysqli_close($link);

?>