<?php
    include "./db.php";
    $conexion = open_database();
    
    $curp = $_POST["curp"];
    $nombre = $_POST["nombre"];
    $primer_ape = $_POST["primer_ape"];
    $segundo_ape = $_POST["segundo_ape"];
    $fecha_nac = $_POST["fecha_nac"];
    $genero = $_POST["genero"];
    $correo = $_POST["correo"];
    $telefono_fijo = $_POST["telefono_fijo"];
    $telefono_cel = $_POST["telefono_cel"];
    $calle = $_POST["calle"];
    $numero_int = $_POST["numero_int"];
    $numero_ext = $_POST["numero_ext"];
    $cp = $_POST["cp"];
    $colonia = $_POST["colonia"];
    $municipio = $_POST["municipio"];
    $estado = $_POST["estado"];
    $bachillerato = $_POST["bachillerato"];
    $nombre_Escuela = $_POST["nombre_Escuela"];
    $escuelas = $_POST["escuelas"];
    $localidad = $_POST["localidad"];
    $formacion_tecnica = $_POST["formacion_tecnica"];
    $formacion_tecnica2 = $_POST["formacion_tecnica2"];
    $promedio = $_POST["promedio"];
    $semestre = $_POST["semestre"];
    $programa_academico = $_POST["programa_academico"];
    $opcion = $_POST["opcion"];

    
    if(mysqli_num_rows(mysqli_query($conexion,"SELECT curp FROM alumno WHERE curp ="."'".$curp."'")) == 0){ //validamos que no esten ya registrados los datos de un alumno
        $dateRegistro = mysqli_fetch_array(mysqli_query($conexion,"SELECT NOW()"));
        $sqlInsAlumno = "INSERT INTO alumno (curp, nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, correo, telefono_celular, telefono_casa, direccion,fecha_registro)
        VALUES ("."'".$curp."','".$nombre."','".$primer_ape."','".$segundo_ape."','".$genero."','".$fecha_nac."','".$correo."','".$telefono_cel."','".$telefono_fijo."','"."$calle, $numero_ext, $colonia, $cp, $municipio, $estado"."','".$dateRegistro[0]."')";
        $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

        if($resInsAlumno != 1){ //valida que la instancia de la tabla alumno si se haya creado
            echo "Ocurrio un error al crear tu registro 1";
            exit(0);
        }
        $sqlInsAlumno = "";
        //mysqli_free_result($resInsAlumno);
    }
    

    if($bachillerato == "Bachillerato general" || $escuelas == 'Otra'){
        if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM escuela WHERE nombre ="."'".$nombre_Escuela."'")) == 0){ //Valida que no exista ya una escuela con el mismo nombre
            $sqlInsAlumno = "INSERT INTO escuela (nombre, localidad, tipo) VALUES ("."'".$nombre_Escuela."','".$localidad."','".$bachillerato."')";
            $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

            if($resInsAlumno != 1){ //Valida que la instancia de la tabla escuela se haya creado correctamente
                echo "Ocurrio un error con el registro 2";
                exit(0);
            }
            $sqlInsAlumno = "";
            //mysqli_free_result($resInsAlumno);
        }
    }

    if($bachillerato == "Bachillerato general" || ($bachillerato == "Bachillerato en línea" && $escuelas == "Otra"))
    {
        if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_escuela WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_escuela
            $sqlID_ESCUELA = "SELECT id_escuela FROM escuela WHERE nombre ="."'".$nombre_Escuela."'";
            $resID_ESCUELA = mysqli_query($conexion,$sqlID_ESCUELA);
            $unicoResID_ESCUELA = mysqli_fetch_row($resID_ESCUELA);

            $sqlInsAlumno = "INSERT INTO alumno_has_escuela (curp_alumno, id_escuela, promedio)
            VALUES ("."'".$curp."','".$unicoResID_ESCUELA[0]."','".$promedio."')";
            $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

            if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                echo "Ocurrio un error con el registro 3";
                exit(0);
            }
            $sqlInsAlumno = "";
            //mysqli_free_result($resInsAlumno);
            //mysqli_free_result($resID_ESCUELA);          
        }
    }
    elseif($bachillerato == "Bachillerato en línea" && $escuelas != "Otra"){
        if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_escuela WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_escuela
            $sqlInsAlumno = "INSERT INTO alumno_has_escuela (curp_alumno, id_escuela, promedio)
            VALUES ("."'".$curp."','".$escuelas."','".$promedio."')";
            $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

            if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                echo "Ocurrio un error con el registro 4";
                exit(0);
            }
            $sqlInsAlumno = "";
            //mysqli_free_result($resInsAlumno);        
        }
    }

    elseif ($bachillerato == "Bachillerato técnico"){

        if($escuelas == 'Otra'){
            if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM formacion_tecnica WHERE nombre ="."'".$formacion_tecnica2."'")) == 0){ //Valida que no exista el nombre de una carrera tecnica mas de 1 vez
                $sqlInsAlumno = "INSERT INTO formacion_tecnica (nombre)
                VALUES ("."'".$formacion_tecnica2."')";
                $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

                if($resInsAlumno != 1){ //Valida que se haya creado correctamente una nueva carrera tecnica
                    echo "Ocurrio un error con el registro 5";
                    exit(0);
                }
                $sqlInsAlumno = "";
                //mysqli_free_result($resInsAlumno); 
            }

            $sqlInsEscuela = "SELECT id_escuela FROM escuela WHERE nombre ="."'".$nombre_Escuela."'"; //obtenemos el id de la escuela
            $resInsEscuela = mysqli_fetch_row(mysqli_query($conexion,$sqlInsEscuela));
            

            $sqlInsFormacion = "SELECT id_formacion_tecnica FROM formacion_tecnica WHERE nombre ="."'".$formacion_tecnica2."'"; //obtenemos el id de la formacion tecnica
            $resInsFormacion = mysqli_fetch_row(mysqli_query($conexion,$sqlInsFormacion));

            if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM escuela_has_formacion WHERE id_escuela ="."'".$resInsEscuela[0]."'"." and id_formacion_tecnica ="."'".$resInsFormacion[0]."'")) == 0){   //Checar que no exista la instancia en la tabla escuela_has_formacion
                if(mysqli_real_query($conexion,"INSERT INTO escuela_has_formacion VALUES ("."'".$resInsEscuela[0]."','".$resInsFormacion[0]."')") != 1){
                    echo "Ocurrio un error con el registro 6";
                    exit(0);
                }
            }

            if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_escuela WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_escuela
                $sqlInsAlumno = "INSERT INTO alumno_has_escuela 
                VALUES ("."'".$curp."','".$resInsEscuela[0]."','".$resInsFormacion[0]."','".$promedio."')";
                $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);
    
                if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                    echo "Ocurrio un error con el registro 7";
                    exit(0);
                }
                $sqlInsAlumno = "";
                //mysqli_free_result($resInsAlumno);
            }
        }
        
        else{
            if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_escuela WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_escuela
                $sqlID_FORMACIONT = "SELECT id_formacion_tecnica FROM formacion_tecnica WHERE nombre ="."'".$formacion_tecnica."'";
                $resID_FORMACIONT = mysqli_query($conexion,$sqlID_FORMACIONT);
                $unicoResID_FORMACIONT = mysqli_fetch_row($resID_FORMACIONT);
                //echo "$unicoResID_FORMACIONT[0]"."<br>";
        
                $sqlInsAlumno = "INSERT INTO alumno_has_escuela
                VALUES ("."'".$curp."','".$escuelas."','".$unicoResID_FORMACIONT[0]."','".$promedio."')";
                $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);
    
                if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                    echo "Ocurrio un error con el registro 8";
                    exit(0);
                }
                $sqlInsAlumno = "";
                //mysqli_free_result($resInsAlumno);
                //mysqli_free_result($resID_FORMACIONT);          
            }
        }  
    }

    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_programa WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_programa
        $sqlInsAlumno = "INSERT INTO alumno_has_programa VALUES ("."'".$curp."','".$semestre."','".$programa_academico."','".$opcion."')";
        $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

        if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_formacion se haya creado correctamente
            echo "Ocurrio un error con el registro 9";
            exit(0);
        }
        $sqlInsAlumno = "";
        //mysqli_free_result($resInsAlumno);
    }

    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM examen WHERE curp_alumno ="."'".$curp."'")) == 0){
        if(mysqli_real_query($conexion,"INSERT INTO examen (curp_alumno) VALUES ("."'".$curp."')") != 1){
            echo "Ocurrio un error con el registro 10";
            exit(0);
        }
    }

    //ASIGNACION DEL GRUPO
    
    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_grupo WHERE curp_alumno ="."'".$curp."'")) == 0){  //Valida que el alumno no tenga un grupo ya asignado
        $dias = array("2021-02-22","2021-02-23","2021-02-24");
        $horas = array("10:00:00","12:00:00","14:00:00","16:00:00");
        $grupos = array("1101","1102","1103","1104","1105");
    
        for($i = 0; $i < count($dias); $i++){
            for($j = 0; $j < count($horas); $j++){
                for($k = 0; $k < count($grupos); $k++){
                    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM grupo WHERE clave ="."'".$grupos[$k]."-".$i.$j."' and horario ="."'".$dias[$i]." ".$horas[$j]."'")) == 0){ // valida que el grupo no exista en la tabla grupo
                        if(mysqli_real_query($conexion,"INSERT INTO grupo VALUES ("."'".$grupos[$k]."-".$i.$j."','".$dias[$i]." ".$horas[$j]."','20')") != 1){ // crea un nuevo grupo
                            echo "Ocurrio un error al crear el registro 11";
                            exit(0);
                        }
                    }
    
                    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_grupo WHERE clave_grupo ="."'".$grupos[$k]."-".$i.$j."'")) < 20){ ///Revisa si todavia hay cupo en un grupo existente
                        if(mysqli_real_query($conexion, "INSERT INTO alumno_has_grupo VALUES ("."'".$curp."','".$grupos[$k]."-".$i.$j."')") != 1){ //inserta al alumno en un grupo con cupo
                            echo "Ocurrio un error al crear el registro 12";
                            exit(0);
                        }
                        else{
                            echo "El registro se realizo correctamente";
                            exit(0);
                        }
                    }
                }
            }
        }
    }
    echo "El registro se realizo correctamente";   
?>

