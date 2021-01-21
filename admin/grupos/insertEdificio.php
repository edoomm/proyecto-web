<?php

if (!isset($_POST["edificio"])) {
    header("Location: ./");
    exit;
}

include_once '../../php/db.php';
$link = open_database();

$edificio = $_POST["edificio"];

$query = "SELECT * FROM Edificio WHERE edificio = '$edificio'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    echo "Edificio ya registrado";
    mysqli_close($link);
    exit;
}

$query = "INSERT INTO Edificio (edificio) VALUE ('$edificio')";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "Ocurrió un error al tratar de crear un nuevo día";
}

mysqli_close($link);

?>