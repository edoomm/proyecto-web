<?php
    include "../db.php";
    $conexion = open_database();

        $sql_dias = "SELECT fecha FROM dia";
        $res_sqlDias = mysqli_query($conexion,$sql_dias);
        $sql_horas = "SELECT hora FROM horario";
        $res_sqlHoras = mysqli_query($conexion,$sql_horas);
        $sql_grupos = "SELECT edificio FROM edificio";
        $res_sqlGrupos = mysqli_query($conexion,$sql_grupos);
        
        $dias = array();
        $horas = array();
        $grupos = array();
        
        while($row = mysqli_fetch_array($res_sqlDias,MYSQLI_BOTH)){
            array_push($dias,$row[0]);
        }

        while($row2 = mysqli_fetch_array($res_sqlHoras,MYSQLI_BOTH)){
            array_push($horas,$row2[0]);
        }  
        
        while($row3 = mysqli_fetch_array($res_sqlGrupos,MYSQLI_BOTH)){
            array_push($grupos,$row3[0]);
        }
        var_dump($dias);
        var_dump($horas);
        var_dump($grupos);  
?>