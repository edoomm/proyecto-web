<?php
    $conexion = mysqli_connect("localhost","root","","sistema_registro");
    mysqli_set_charset($conexion, "UTF8");
    
    $sqlInsAlumno = "SELECT nombre FROM escuela";
    $resInsAlumno = mysqli_query($conexion,$sqlInsAlumno);
    $escuelas = "";
    $cont = 1;
    while($filas = mysqli_fetch_array($resInsAlumno,MYSQLI_BOTH)){
        $escuelas = $escuelas.'<option value="'.$cont.'">'."$filas[0]".'</option>';
        $cont++;
    }
    $escuelas .= '<option value='.'Otro'.'>'.'Otro'.'</option>';
    echo $escuelas;
?>

