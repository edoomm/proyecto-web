<?php
    include_once "../../php/db.php";
    $conexion = open_database();

    $sql_escuelas = "SELECT id_escuela,nombre FROM escuela WHERE nombre != 'OTRA'";
    $res_escuelas = mysqli_query($conexion,$sql_escuelas);

    $llenar_tabla_escuelas = "";
    $contador = 0;
    $alumnos_cecyt = 0;
    $alumnos_otraEsc = 0;

    while($row = mysqli_fetch_array($res_escuelas,MYSQLI_BOTH)){
        $sql_numAlumnos = "SELECT COUNT(id_escuela) FROM alumno_has_escuela WHERE id_escuela=$row[0]";
        $res_numAlumnos = mysqli_fetch_row(mysqli_query($conexion,$sql_numAlumnos));

        if($row[0] > 0 && $row[0] < 21){
            $alumnos_cecyt += $res_numAlumnos[0];
        }
        else{
            $alumnos_otraEsc += $res_numAlumnos[0];
        }

        $contador += $res_numAlumnos[0]; 
        $llenar_tabla_escuelas .= "<tr><td>$row[1]</td><td>$res_numAlumnos[0]</td></tr>";
    }
    $llenar_tabla_escuelas .= "<tr><td><b>Total de Alumnos</b></td><td><b>$contador</b></td></tr>";
    mysqli_close ($conexion);
?>