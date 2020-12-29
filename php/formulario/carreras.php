<?php
    $mySelect = $_POST["escuela"];
    $conexion = mysqli_connect("localhost","root","","sistema_registro");
    mysqli_set_charset($conexion, "UTF8");
    
    $sqlInsAlumno = "SELECT nombre FROM formacion_tecnica,escuela_has_formacion WHERE id_escuela =".$mySelect." AND formacion_tecnica.id_formacion_tecnica = escuela_has_formacion.id_formacion_tecnica";
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $carreras = [];
    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $carreras[] = $filas[0];
    }
    echo json_encode($carreras);
    //echo print_r($carreras);
?>