<?php

if (!isset($_POST["edificio"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$edificio = $_POST["edificio"];

$query = "DELETE FROM Edificio WHERE edificio = '$edificio'";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "No se pudo eliminar el edificio, intentelo más tarde";
}

mysqli_close($link);

?>