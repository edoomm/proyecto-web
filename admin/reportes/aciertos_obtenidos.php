<?php
    include_once "../../php/db.php";
    $conexion = open_database();

    $numero_preguntas = 128;
    $rango = 40;
    $contador = 0;

    $sql_alumSIEX = "SELECT COUNT(aciertos) FROM alumno_has_grupo WHERE aciertos >= 0";
    $res_alumSIEX = mysqli_fetch_row(mysqli_query($conexion,$sql_alumSIEX)); 

    $num_filas = intdiv($numero_preguntas,$rango);
    $restante = $numero_preguntas%$rango;


    $inicio_rango = 0;
    $fin_rango = 0;
    $data_rango = array();
    $data_numAlumnos = array();

    $llenar_tabla_aciertos_obtenidos = "";

    for($i = 0; $i < $num_filas; $i++){
        $fin_rango += $rango;

        $sql_numAlumnos = "SELECT COUNt(aciertos) FROM alumno_has_grupo WHERE aciertos >= $inicio_rango AND aciertos <= $fin_rango";
        $res_numAlumnos = mysqli_fetch_row(mysqli_query($conexion,$sql_numAlumnos));
        array_push($data_numAlumnos,$res_numAlumnos[0]);
        $contador += $res_numAlumnos[0];

        $porcentaje = bcdiv($res_numAlumnos[0],$res_alumSIEX[0],4)*100;

        $llenar_tabla_aciertos_obtenidos .= "<tr><td>$inicio_rango - $fin_rango</td><td>$res_numAlumnos[0]</td><td>$porcentaje%</td></tr>";
        array_push($data_rango,"$inicio_rango - $fin_rango");
        $inicio_rango = $fin_rango + 1;
    }

    if($restante > 0){
        $fin_rango += $restante;

        $sql_numAlumnos = "SELECT COUNt(aciertos) FROM alumno_has_grupo WHERE aciertos >= $inicio_rango AND aciertos <= $fin_rango";
        $res_numAlumnos = mysqli_fetch_row(mysqli_query($conexion,$sql_numAlumnos));
        array_push($data_numAlumnos,$res_numAlumnos[0]);
        $contador += $res_numAlumnos[0];

        $porcentaje = bcdiv($res_numAlumnos[0],$res_alumSIEX[0],4)*100;
        if($fin_rango != $inicio_rango){
            $llenar_tabla_aciertos_obtenidos .= "<tr><td>$inicio_rango - $fin_rango</td><td>$res_numAlumnos[0]</td><td>$porcentaje%</td></tr>";
            array_push($data_rango,"$inicio_rango - $fin_rango");
        }
        else{
            $llenar_tabla_aciertos_obtenidos .= "<tr><td>$inicio_rango</td><td>$res_numAlumnos[0]</td><td>$porcentaje%</td></tr>";
            array_push($data_rango,"$inicio_rango");
        }
    }

    $llenar_tabla_aciertos_obtenidos .= "<tr><td><b>Total de Alumnos</b></td><td><b>$contador</b></td><td><b>100%</b></td></tr>";
?>