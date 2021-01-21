<?php
    include_once "../../php/db.php";
    $conexion = open_database();

    $opciones = 4;
    $llenar_tabla_opcion = "";
    $contador = 0;
    $tabla_opciones = array();
    $data_opciones = array();

    for($i = 0; $i < $opciones; $i++){
        $sql_numAlumnos = "SELECT COUNT(opcion) FROM alumno_has_programa WHERE opcion =".($i+1);
        $res_numAlumnos = mysqli_fetch_row(mysqli_query($conexion,$sql_numAlumnos));
        $contador += $res_numAlumnos[0];
        array_push($data_opciones,$res_numAlumnos[0]);

        if($i+1 == $opciones){
            $llenar_tabla_opcion .= "<tr><td>ESCOM no estuvo en sus opciones</td><td>$res_numAlumnos[0]</td></tr>";
            array_push($tabla_opciones,"ESCOM no estuvo en sus opciones");
        }
        else{
            $u = $i+1;
            array_push($tabla_opciones,"$u");
            $llenar_tabla_opcion .= "<tr><td>".($i+1)."</td><td>$res_numAlumnos[0]</td></tr>";
        }
    }
    $llenar_tabla_opcion .= "<tr><td><b>Total de Alumnos</b></td><td><b>$contador</b></td></tr>";
    mysqli_close ($conexion);
?>