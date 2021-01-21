<?php

if (!isset($_POST["curp"])) {
    header("Location: ../");
    exit;
}

include_once '../../../php/db.php';
$link = open_database();

$curp = $_POST["curp"];

$nombre = $_POST["nombre"];
$primer_apellido = $_POST["apepat"];
$segundo_apellido = $_POST["apemat"];
$genero = $_POST["genero"];
$fecha_nacimiento = $_POST["fechanac"];
$correo = $_POST["email"];
$telefono_celular = $_POST["telcelular"];
$telefono_casa = $_POST["telfijo"];
$direccion = $_POST["direccion"];

$query = "UPDATE Alumno SET nombre = '$nombre', primer_apellido = '$primer_apellido', segundo_apellido = '$segundo_apellido', "
    . "genero = '$genero', fecha_nacimiento = '$fecha_nacimiento', correo = '$correo', telefono_celular = '$telefono_celular', "
    . "telefono_casa = '$telefono_casa', direccion = '$direccion' WHERE curp = '$curp'";
$result = mysqli_query($link, $query);

if ($result)
    echo "true";
else
    echo "false";

mysqli_close($link);

?>