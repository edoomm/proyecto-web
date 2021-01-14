<?php
    include "./db.php";
    $conexion = open_database();

    $mySelect = $_POST["escuela"];
    
    $sqlInsAlumno = "SELECT nombre FROM formacion_tecnica,escuela_has_formacion WHERE id_escuela =".$mySelect." AND formacion_tecnica.id_formacion_tecnica = escuela_has_formacion.id_formacion_tecnica";
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $carreras = [];
    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $carreras[] = $filas[0];
    }
    mysqli_close ($conexion);
    echo json_encode($carreras);
?>