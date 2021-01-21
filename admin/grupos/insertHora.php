<?php

if (!isset($_POST["hora"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$hora = $_POST["hora"] . ":00";

$query = "SELECT * FROM Horario WHERE hora = '$hora'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    echo "Horario ya registrado";
    mysqli_close($link);
    exit;
}

$query = "INSERT INTO Horario (hora) VALUE ('$hora')";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "Ocurrió un error al tratar de crear un nuevo día";
}

mysqli_close($link);

?>