<?php

if (!isset($_POST["curp"])) {
    header("Location: ../");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$grupo = $_POST["grupo"];
$aciertos = $_POST["aciertos"];

$query = "UPDATE Alumno_has_grupo SET clave_grupo = '$grupo', aciertos = $aciertos WHERE curp_alumno = '$curp'";
$result = mysqli_query($link, $query);

if ($result) {
    echo "true";
}
else {
    echo "false";
}

mysqli_close($link);

?>