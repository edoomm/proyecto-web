<?php
    include "../db.php";
    $conexion = open_database();
    
    $mySelect = $_POST["escuela"];
    
    $sqlInsAlumno = "SELECT localidad FROM escuela WHERE id_escuela =".$mySelect;
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $ubicacion = "";

    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $ubicacion .= "$filas[0]";
    }
    mysqli_close ($conexion);
    echo $ubicacion;
?>