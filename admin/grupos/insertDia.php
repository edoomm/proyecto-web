<?php

if (!isset($_POST["fecha"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$fecha = $_POST["fecha"];

$query = "SELECT * FROM Dia WHERE fecha = '$fecha'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    echo "Dia ya registrado";
    mysqli_close($link);
    exit;
}

$query = "INSERT INTO Dia (fecha) VALUE ('$fecha')";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "Ocurrió un error al tratar de crear un nuevo día";
}

mysqli_close($link);

?>