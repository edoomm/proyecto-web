<?php
    include "./db.php";
    $conexion = open_database();

    $i = 0;
    $j = 0;
    $k = 0;
    $curp = "TEFDSWER09332323ET";
    $grupos = array("1101");
    $dias = array("2021-02-22");
    $horas = array("10:00:00");

    
    //echo mysqli_num_rows(mysqli_query($conexion,$sql));
    echo mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM examen WHERE curp_alumno ="."'".$curp."'"));

    // $sql = "SELECT * FROM grupo WHERE clave = '$grupos[0]-$i$j' and horario = '$dias[0] $horas[0]'";
    // $res = mysqli_fetch_row(mysqli_query($conexion,$sql));


    
    //echo $res[0];

    // $curp = "CERI000722HDFRVNA9";
    // $nombre = "Ian";
    // $primer_ape = "Ceron";
    // $segundo_ape = "Rivera";
    // $genero = "Masculino";
    // $fecha_nac = "2000-07-22";
    // $correo = "Ian.cr@outlook.com";
    // $telefono_cel = 5544562483;
    // $telefono_fijo = 5553643984;
    // $calle = "Avenida Colinas";
    // $numero_ext = 73;
    // $colonia = "Colinas de San Mateo";
    // $cp = 53218;
    // $municipio = "Naucalpan";
    // $estado = "Estado de México";

    // $sqlInsAlumno = "INSERT INTO alumno (curp, nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, correo, telefono_celular, telefono_casa, direccion)
    // VALUES ("."'".$curp."','".$nombre."','".$primer_ape."','".$segundo_ape."','".$genero."','".$fecha_nac."','".$correo."','".$telefono_cel."','".$telefono_fijo."','"."$calle, $numero_ext, $colonia, $cp, $municipio, $estado"."')";
    // $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

    // echo $resInsAlumno;
    // echo gettype($resInsAlumno);
    
    ///mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM escuela WHERE nombre = '$nombre_Escuela'"))
    
    // $nombre_Escuela = 'CECyT No. 2 "Miguel Bernard"';
    // $sql = "SELECT * FROM escuela WHERE nombre ="."'".$nombre_Escuela."'";
    // echo $sql."<br>";


    // printf("\n%d",mysqli_num_rows(mysqli_query($conexion,$sql)));

?>