<?php
    include_once "../../php/db.php";
    $conexion = open_database();

    $sql_programas_academicos = "SELECT * FROM programa_academico";
    $res_programas_academicos = mysqli_query($conexion,$sql_programas_academicos);
    
    $llena_tabla_general = "";
    $contador_Alumnos = 0;
    $contador_F = 0;
    $contador_M = 0;
    $contador_N = 0;

    while($row = mysqli_fetch_array($res_programas_academicos,MYSQLI_BOTH)){

        $sql_totalAlumnos = "SELECT COUNT(id_programa_academico) FROM alumno_has_programa WHERE id_programa_academico=$row[0]";
        $res_totalAlumnos = mysqli_fetch_row(mysqli_query($conexion,$sql_totalAlumnos));
        $contador_Alumnos += $res_totalAlumnos[0];

        $sql_F = "SELECT COUNT(genero) FROM alumno, alumno_has_programa WHERE id_programa_academico=$row[0] AND curp=curp_alumno AND genero='F'";
        $res_F = mysqli_fetch_row(mysqli_query($conexion,$sql_F));
        $contador_F += $res_F[0];

        $sql_M = "SELECT COUNT(genero) FROM alumno, alumno_has_programa WHERE id_programa_academico=$row[0] AND curp=curp_alumno AND genero='M'";
        $res_M = mysqli_fetch_row(mysqli_query($conexion,$sql_M));
        $contador_M += $res_M[0];

        $sql_N = "SELECT COUNT(genero) FROM alumno, alumno_has_programa WHERE id_programa_academico=$row[0] AND curp=curp_alumno AND genero='N'";
        $res_N = mysqli_fetch_row(mysqli_query($conexion,$sql_N));
        $contador_N += $res_N[0];

        $sql_prom = "SELECT alumno_has_programa.curp_alumno, aciertos FROM alumno_has_programa, alumno_has_grupo WHERE id_programa_academico=$row[0] AND alumno_has_programa.curp_alumno=alumno_has_grupo.curp_alumno AND aciertos >= 0";
        $res_prom = mysqli_query($conexion,$sql_prom);
        $num_alumnos = mysqli_num_rows($res_prom);

        $suma = 0;
        $promedio = 0;
        while($row2 = mysqli_fetch_array($res_prom,MYSQLI_BOTH)){
            $suma += $row2[1];
        }

        if($num_alumnos > 0){
            $promedio = bcdiv($suma,$num_alumnos,2);
        }
        $llena_tabla_general .= "<tr><td>$row[1]</td><td>$res_totalAlumnos[0]</td><td>$res_F[0]</td><td>$res_M[0]</td><td>$res_N[0]</td><td>$promedio</td><td>$num_alumnos</td></tr>";
    }
    $llena_tabla_general .= "<tr><td><b>Total de Alumnos</b></td><td><b>$contador_Alumnos</b></td><td><b>$contador_F</b></td><td><b>$contador_M</b></td><td><b>$contador_N</b></td><td></td><td></td></tr>";
    mysqli_close ($conexion);
?>