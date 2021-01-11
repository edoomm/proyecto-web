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
    $contrasena = md5($_POST["contrasena"]);
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
    $respAX = [];
    
    if(mysqli_num_rows(mysqli_query($conexion,"SELECT curp FROM alumno WHERE curp ="."'".$curp."'")) == 0){ //validamos que no esten ya registrados los datos de un alumno
        $dateRegistro = mysqli_fetch_array(mysqli_query($conexion,"SELECT NOW()"));
        $sqlInsAlumno = "INSERT INTO alumno
        VALUES ("."'".$curp."','".$nombre."','".$primer_ape."','".$segundo_ape."','".$genero."','".$fecha_nac."','".$correo."','".$telefono_cel."','".$telefono_fijo."','"."$calle, $numero_ext, $colonia, $cp, $municipio, $estado"."','".$contrasena."','".$dateRegistro[0]."')";
        $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);

        if($resInsAlumno != 1){ //valida que la instancia de la tabla alumno si se haya creado
            $respAX["cod"] = 0;
            $respAX["msj"] = "(1) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
            mysqli_close ($conexion);
            echo json_encode($respAX);
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
                $respAX["cod"] = 0;
                $respAX["msj"] = "(2) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                mysqli_close ($conexion);
                echo json_encode($respAX);
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
                $respAX["cod"] = 0;
                $respAX["msj"] = "(3) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                mysqli_close ($conexion);
                echo json_encode($respAX);
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
                $respAX["cod"] = 0;
                $respAX["msj"] = "(4) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                mysqli_close ($conexion);
                echo json_encode($respAX);
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
                    $respAX["cod"] = 0;
                    $respAX["msj"] = "(5) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                    mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                    mysqli_close ($conexion);
                    echo json_encode($respAX);
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
                    $respAX["cod"] = 0;
                    $respAX["msj"] = "(6) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                    mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                    mysqli_close ($conexion);
                    echo json_encode($respAX);
                    exit(0);
                }
            }

            if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_escuela WHERE curp_alumno ="."'".$curp."'")) == 0){ //Valida que no exista el mismo alumno con mas de 1 registro en la tabla alumno_has_escuela
                $sqlInsAlumno = "INSERT INTO alumno_has_escuela 
                VALUES ("."'".$curp."','".$resInsEscuela[0]."','".$resInsFormacion[0]."','".$promedio."')";
                $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);
    
                if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                    $respAX["cod"] = 0;
                    $respAX["msj"] = "(7) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                    mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                    mysqli_close ($conexion);
                    echo json_encode($respAX);
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
                
        
                $sqlInsAlumno = "INSERT INTO alumno_has_escuela
                VALUES ("."'".$curp."','".$escuelas."','".$unicoResID_FORMACIONT[0]."','".$promedio."')";
                $resInsAlumno = mysqli_real_query($conexion,$sqlInsAlumno);
    
                if($resInsAlumno != 1){ //Valida que la instancia de la tabla alumno_has_escuela se haya creado correctamente
                    $respAX["cod"] = 0;
                    $respAX["msj"] = "(8) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                    mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                    mysqli_close ($conexion);
                    echo json_encode($respAX);
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
            $respAX["cod"] = 0;
            $respAX["msj"] = "(9) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
            mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
            mysqli_close ($conexion);
            echo json_encode($respAX);
            exit(0);
        }
        $sqlInsAlumno = "";
        //mysqli_free_result($resInsAlumno);
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
                            $respAX["cod"] = 0;
                            $respAX["msj"] = "(10) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                            mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                            mysqli_close ($conexion);
                            echo json_encode($respAX);
                            exit(0);
                        }
                    }
                    
                    $cupos_grupo = mysqli_fetch_array(mysqli_query($conexion,"SELECT cupo FROM grupo WHERE clave ="."'".$grupos[$k]."-".$i.$j."'"));

                    if(mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM alumno_has_grupo WHERE clave_grupo ="."'".$grupos[$k]."-".$i.$j."'")) < $cupos_grupo[0]){ ///Revisa si todavia hay cupo en un grupo existente
                        if(mysqli_real_query($conexion, "INSERT INTO alumno_has_grupo VALUES ("."'".$curp."','".$grupos[$k]."-".$i.$j."','-1')") != 1){ //inserta al alumno en un grupo con cupo
                            $respAX["cod"] = 0;
                            $respAX["msj"] = "(11) Ocurrio un error al crear tu registro. Por favor prueba enviando nuevamente el formulario, si el problema persiste, comunícate con nosotros al correo...";
                            mysqli_real_query($conexion,"DELETE FROM alumno WHERE curp ="."'".$curp."'");
                            mysqli_close ($conexion);
                            echo json_encode($respAX);
                            exit(0);
                        }
                        else{
                            $respAX["cod"] = 1;
                            $respAX["msj"] = "¡El registro se realizo correctamente!";
                            mysqli_close ($conexion);
                            echo json_encode($respAX);
                            exit(0);
                        }
                    }
                }
            }
        }
    }

    $respAX["cod"] = 2;
    $respAX["msj"] = "Ya existe un registro asociado al curp: "."$curp"." si no fuiste tu quien realizo el registro por favor
    comunícate al correo... para ayudarte a resolver tu situación, si solo deseas actualizar alguno de tus datos, 
    debes iniciar sesión y desde tu perfil puedes hacerlo.";
    mysqli_close ($conexion);
    echo json_encode($respAX);   
?>

