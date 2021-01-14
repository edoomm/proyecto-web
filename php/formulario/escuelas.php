<?php
    include "./db.php";
    $conexion = open_database();

    $bachillerato = $_POST["bachillerato"];
    
    if($bachillerato == "BACHILLERATO TÉCNICO"){
        $sqlInsAlumno = "SELECT nombre FROM escuela WHERE id_escuela >= 1 and id_escuela <= 21";
    }

    else if($bachillerato == "BACHILLERATO EN LÍNEA"){
        $sqlInsAlumno = "SELECT nombre FROM escuela WHERE id_escuela = 10 or id_escuela = 21";
    }
    
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $escuelas = [];
    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $escuelas[] = $filas[0];
    }
    mysqli_close ($conexion);
    echo json_encode($escuelas); 
?>