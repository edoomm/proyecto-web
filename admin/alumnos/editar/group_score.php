<?php

if (!isset($_POST["curp"])) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = '';
    header("Location: http://$host$uri/$extra");
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