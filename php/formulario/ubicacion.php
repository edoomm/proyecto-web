<?php
    $mySelect = $_POST["escuela"];
    $conexion = mysqli_connect("localhost","root","","sistema_registro");
    mysqli_set_charset($conexion, "UTF8");
    
    $sqlInsAlumno = "SELECT localidad FROM escuela WHERE id_escuela =".$mySelect;
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $ubicacion = "";

    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $ubicacion .= "$filas[0]";
    }
    echo $ubicacion;
    
?>