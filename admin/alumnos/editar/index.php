<?php

session_start();
if (!isset($_SESSION["id"])) {
    header("location:../../");
    exit;
}

if (!isset($_POST["txtCurp"])) {
    header("Location:../");
    exit;
}

$curp = $_POST["txtCurp"];

include '../../../php/db.php';
$conn = open_database();

// retrieving personal info
$query = "SELECT * FROM Alumno WHERE curp = '$curp'";
$resultPersonal = mysqli_query($conn, $query);
$personal = mysqli_fetch_array($resultPersonal);
$nombre = $personal["nombre"];
$primer_apellido = $personal["primer_apellido"];
$segundo_apellido = $personal["segundo_apellido"];
$genero = $personal["genero"];
$fecha_nacimiento = $personal["fecha_nacimiento"];
$correo = $personal["correo"];
$telefono_celular = $personal["telefono_celular"];
$telefono_casa = $personal["telefono_casa"];
$direccion = $personal["direccion"];
$fecha_registro = $personal["fecha_registro"];

// aciertos & grupo
$aciertos = "";
$grupo_alumno = "NULL";

$queryAG = "SELECT clave_grupo, aciertos FROM Alumno_has_Grupo WHERE curp_alumno = '$curp'";
$resultAG = mysqli_query($conn, $queryAG);
if (mysqli_num_rows($resultAG) != 0) {
    $rowAG = mysqli_fetch_array($resultAG);

    $aciertos = $rowAG["aciertos"];
    $grupo_alumno = $rowAG["clave_grupo"];
}

//escuela
$nombre_escuela = "";
$localidad_escuela = "";
$promedio = "";

$queryAE = "SELECT * FROM Alumno_has_Escuela WHERE curp_alumno = '$curp'";
$resultAE = mysqli_query($conn, $queryAE);
if (mysqli_num_rows($resultAE) != 0) {
    $rowAE = mysqli_fetch_array($resultAE);

    $id_escuela = $rowAE["id_escuela"];
    $id_formacion = $rowAE["id_formacion_tecnica"];
    $promedio = $rowAE["promedio"];

    // retrieving school info
    $query_escuela = "SELECT * from Escuela WHERE id_escuela = $id_escuela";
    $result_escuela = mysqli_query($conn, $query_escuela);
    $row_escuela = mysqli_fetch_array($result_escuela);
    $nombre_escuela = $row_escuela["nombre"];
    $localidad_escuela = $row_escuela["localidad"];
    $tipo = $row_escuela["tipo"];
}
if($tipo == "BACHILLERATO TÉCNICO" && $id_formacion == NULL){
    $tipo = "BACHILLERATO EN LÍNEA";
}

$nombre_formacion_tecnica = "";
if($id_formacion != NULL){
    $queryFT = "SELECT nombre FROM formacion_tecnica WHERE id_formacion_tecnica = $id_formacion";
    $row_formacion_tecnica = mysqli_fetch_array(mysqli_query($conn,$queryFT));
    $nombre_formacion_tecnica = $row_formacion_tecnica["nombre"];
}

// programa
$semestre = "";
$programa_academico = "";
$opcion = null;

$queryAP = "SELECT * FROM Alumno_has_Programa WHERE curp_alumno = '$curp'";
$resultAP = mysqli_query($conn, $queryAP);
if (mysqli_num_rows($resultAP) != 0) {
    $rowAP = mysqli_fetch_array($resultAP);

    $semestre = $rowAP["semestre"];
    $opcion = $rowAP["opcion"];
    $id_programa_academico = $rowAP["id_programa_academico"];

    $query_programa = "SELECT id_programa_academico FROM Programa_Academico WHERE id_programa_academico = $id_programa_academico";
    $result_programa = mysqli_query($conn, $query_programa);
    $row_programa = mysqli_fetch_array($result_programa);
    $programa_academico = $row_programa["id_programa_academico"];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Editar alumno</title>
    <meta name='viewport'
        content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no' />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Validetta -->
    <link rel="stylesheet" href="../../../css/validetta.min.css">
    <style>
        /* Con esto se puede cambiar el color del texto de los select
        input.select-dropdown.dropdown-trigger {
            color: #ab9eab;
        } */
    </style>
</head>

<body>
    
    <!-- Top navbar -->
    <header>
        <nav>
            <div class="nav-wrapper blue">
                <ul id="nav-mobile" class="left" style="position: absolute; left: -1%; top: 50%; -webkit-transform: translate(0%, -50%); transform: translate(0%, -50%);">
                    <a href="../../alumnos/"><li><i class="material-icons">chevron_left</i></li></a>
                </ul>
                <ul id="nav-mobile" class="right">
                    <div class="right">
                        <li><a href="#">Acerca de</a></li>
                        <li><a href="../../logout.php?nombreSesion=id">Salir</a></li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <form id="studentData">
            <!-- Grupos y aciertos -->
            <div class="container" style="padding-top: 10px;">
                <div class="row">

                    <?php
                    // retrieving grupos
                    $queryGrupos = "SELECT clave FROM Grupo";
                    $resultGrupos = mysqli_query($conn, $queryGrupos);
                    ?>

                    <div class="col l6 m6 s12">
                        <label for="grupo">Grupo</label>
                        <select id="grupo">
                            <option value="NULL" disabled selected>Sin grupo asignado</option>
                            <?php
                            // fetch Grupo array
                            while ($rowGrupos = mysqli_fetch_array($resultGrupos)) {
                                $grupo = $rowGrupos["clave"];
                            ?>
                            <option value="<?php echo $grupo; ?>"><?php echo $grupo; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col l6 m6 s12">
                        <label for="aciertos">Aciertos</label>
                        <input type="number" name="aciertos" id="aciertos" value="<?php echo $aciertos; ?>" data-validetta="regExp[aciertos]" required>
                    </div>
                </div>
            </div>

            <ul class="collapsible expandable">
                <!-- Datos personales -->
                <li>
                    <div class="collapsible-header"><i class="material-icons">person</i>Datos personales</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row input-field">
                                <label for="curp">CURP</label>
                                <input type="text" name="curp" id="curp" disabled value="<?php echo $curp; ?>">
                            </div>
                            <div class="row input-field">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s12 input-field">
                                    <label for="apellidopat">Primer apellido</label>
                                    <input type="text" name="apellidopat" id="apellidopat" value="<?php echo $primer_apellido; ?>" required>
                                </div>
                                <div class="col l6 m6 s12 input-field">
                                    <label for="apellidomat">Segundo apellido</label>
                                    <input type="text" name="apellidomat" id="apellidomat" value="<?php echo $segundo_apellido; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6 input-field">
                                    <label for="fecha-nac">Fecha de nacimiento</label>
                                    <input type="text" class="datepicker" id="fecha-nac" name="fecha-nac" value="<?php echo $fecha_nacimiento; ?>" required>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <select id="genero">
                                        <option value="" disabled selected>G&eacute;nero</option>
                                        <option value="M">MASCULINO</option>
                                        <option value="F">FEMENINO</option>
                                        <option value="N">PREFIERO NO DECIRLO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row input-field">
                                <!-- <label for="correo">Correo electronico</label>
                                <input type="email" name="correo" id="correo" value="<?php echo $correo; ?>" required> -->
                                <input id="email" type="email" class="validate" value="<?php echo $correo; ?>" required>
                                <label for="email">Correo electronico</label>
                                <span class="helper-text" data-error="Incorrecto" data-success="Correcto"></span>
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s12 input-field">
                                    <label for="telfijo">Teléfono fijo</label>
                                    <input type="text" name="telfijo" id="telfijo" value="<?php echo $telefono_casa; ?>">
                                </div>
                                <div class="col l6 m6 s12 input-field">
                                    <label for="telcelular">Teléfono celular</label>
                                    <input type="text" name="telcelular" id="telcelular" value="<?php echo $telefono_celular; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Datos de domicilio -->
                <li>
                    <div class="collapsible-header"><i class="material-icons">home</i>Datos de domicilio</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row input-field">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>" required>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Escuela de procedencia -->
                <li>
                    <div class="collapsible-header" onclick="updateSchool()"><i class="material-icons">school</i>Escuela de procedencia</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <select id="bachillerato" name="bachillerato" data-validetta="required">
                                        <option value="" disabled>TIPO DE BACHILLERATO</option>
                                        <option value="BACHILLERATO GENERAL">BACHILLERATO GENERAL</option>
                                        <option value="BACHILLERATO TÉCNICO">BACHILLERATO T&Eacute;CNICO</option>
                                        <option value="BACHILLERATO EN LÍNEA">BACHILLERATO EN L&Iacute;NEA</option>
                                    </select>
                                </div>

                                <div id="nombre_escuela" class="col s12 m6 input-field">
                                    <label for="nombre_Escuela">Nombre de la escuela</label>
                                    <input type="text" name="nombre_Escuela" id="nombre_Escuela" value="<?php echo $nombre_escuela; ?>" onkeyup="mayuscula(this)"> 
                                </div>

                                <div id="box_escuela_1" class="input-field col s12 m6">
                                    <select id="escuelas" name="escuelas">
                                        <option value="" disabled>SELECIONA ESCUELA</option>
                                    
                                    </select>
                                </div>

                                <div class="col s12 input-field">
                                    <label for="localidad">Localidad</label>
                                    <input type="text" name="localidad" id="localidad" value="<?php echo $localidad_escuela; ?>" onkeyup="mayuscula(this)"
                                        data-validetta="required">
                                </div>

                                <div id="box_formacion_tecnica" class="col s12 input-field">
                                    <select id="formacion_tecnica" name="formacion_tecnica">
                                        <option value="" disabled>FORMACI&Oacute;N T&Eacute;CNICA OBTENIDA</option>
                                    </select>
                                </div>

                                <div id="input_formacion_tecnica" class="col s12 input-field">
                                    <label for="formacion_tecnica2">Formaci&oacute;n t&eacute;cnica obtenida</label>
                                    <input type="text" name="formacion_tecnica2" id="formacion_tecnica2" onkeyup="mayuscula(this)">
                                </div>

                                <div class="col s12 input-field">
                                    <label for="promedio">Promedio obtenido</label>
                                    <input type="text" name="promedio" id="promedio" value="<?php echo $promedio; ?>" data-validetta="required">
                                </div>
                            </div>

                            <input type="text" name="escuela_nuevo" id="escuela_nuevo" hidden>

                        </div> 
                    </div>
                </li>
                <!-- Programa academico -->
                <li>
                    <div class="collapsible-header"><i class="material-icons">book</i>Programa académico</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row input-field">
                                <label for="semestre">Semestre</label>
                                <input type="text" name="semestre" id="semestre" value="<?php echo $semestre; ?>" required>
                            </div>
                            <div class="row input-field">
                                <?php
                                // retrieving programas
                                $query_programa = "SELECT id_programa_academico AS id, nombre FROM Programa_Academico";
                                $result_programa = mysqli_query($conn, $query_programa);

                                ?>
                                
                                <label for="programaacad" class="active">Programa acad&eacute;mico</label>
                                <select name="programaacad" id="programaacad">
                                    <?php
                                    while ($row = mysqli_fetch_array($result_programa)) {
                                    ?>
                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <!-- <input type="text" name="programaacad" id="programaacad" value="<?php echo $programa_academico; ?>"> -->
                            </div>
                            <div class="row input-field">
                                <label for="opcion">Opción</label>
                                <input type="text" name="opcion" id="opcion" value="<?php echo $opcion; ?>" required>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="form-field">
                <button class="btn-large waves-effect waves-dark blue" style="width: 100%;" id="btnSave">Guardar</button>
            </div><br>
            <div class="form-field">
                <button class="btn-large waves-effect waves-dark white red-text" style="width: 100%;" id="btnDelete">Eliminar</button>
            </div><br>
        </form>
    </main>

    <footer>

    </footer>

    <div class="scripts">
        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!-- Validetta -->
        <script src="../../../js/validetta.min.js"></script>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>

<script>
    let BACH_GEN = "BACHILLERATO GENERAL";
    let BACH_LIN = "BACHILLERATO EN LÍNEA";
    let BACH_TEC = "BACHILLERATO TÉCNICO";

    $(document).ready(function(){
        // Intializing 
        intializeControls();
        intializeData();
        // update [input=text]
        M.updateTextFields();
        
        $("#bachillerato").change(function () { //SI LLEGAN A MODIFICAR LOS DATOS DE LA ESCUELA
            $("#nombre_Escuela").val('');
            $("#localidad").val('');
            $("#formacion_tecnica2").val('');
            resetCarreras();
            resetEscuelas();
            cambiarSelect();
            M.updateTextFields();
        });

        $("#escuelas").change(function () {
            var esc = $("#escuelas").val();
            var bachillerato = $("#bachillerato").val();
            $("#localidad").val('');

            if (bachillerato == "BACHILLERATO TÉCNICO") {
                $("#formacion_tecnica2").val('');
                resetCarreras();
                if (esc != "OTRA") {
                    cambiarCarreras(esc);
                }
                mismoSelect(esc, 1);
            } else if (bachillerato == "BACHILLERATO EN LÍNEA") {
                mismoSelect(esc, 2);
            }
        });
    });

    function intializeControls() {
        $(function(){
            $('.collapsible').collapsible();
            var elem = document.querySelector('.collapsible.expandable');
            var instance = M.Collapsible.init(elem, {
                accordion: false
            });
            $('select').formSelect();

            intializeDatePicker();
            intializeValidetta();
        });
    }

    function intializeDatePicker() {
        $(function(){
            var today = new Date();
            var minFecha = today.getFullYear() - 70;
            var maxFecha = today.getFullYear() - 10;

            var rango = [minFecha+1, maxFecha];
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                autoClose: true,
                minDate: new Date(minFecha, 0, 1),
                maxDate: new Date(maxFecha, 11, 31),
                yearRange: rango,
                i18n: {
                    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'AG', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
                }
            });
        });
    }

    function intializeValidetta() {
        $(function(){
            // intializing validetta
            $("#studentData").validetta({
                validators: {
                    regExp: {
                        aciertos : {
                            pattern: /(^[1-3][0-9]{2}$)|(^[1-9][0-9]$)|(^[0-9]$)|(^-1$)/,
                            errorMessage: "Rango aceptado valido: [-1, 399]"
                        },
                        promedio : {
                            pattern: /^(10)$|(^(\b[0-9]\b)(\.\b[0-9]{1,2}\b)?$)/,
                            errorMessage: "Promedio no valido"
                        },
                        fecha : {
                            pattern: /^(19\d{2}|20(0|1)\d)-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/,
                            errorMessage: "Fecha no valida"
                        }
                    }
                },
                realTime : true,
                bubblePosition: 'bottom',
                onValid : function (e) {
                    submitForm();
                }
            });

            // hiding when control gets focus
            $("form input").focus(function(){
                let parent = $(this).parent();
                if(parent.hasClass("validetta-error") == true){
                    parent.removeClass("validetta-error");
                    parent.find("span.validetta-bubble").remove();
                }
            });
        });
    }

    function intializeData () {
        $(function(){
            // Student info
            let tipo = "<?php echo $tipo; ?>";
            let id_escuela = <?php echo $id_escuela; ?>;

            if(tipo == 'BACHILLERATO GENERAL'){
                $("#box_escuela_1").css("display","none"); //OCULTAMOS LOS CAMPOS QUE NO VAMOS A OCUPAR
                $("#box_formacion_tecnica").css("display","none");
                $("#input_formacion_tecnica").css("display","none");
                $("#nombre_Escuela").val('<?php echo $nombre_escuela; ?>'); 
            }

            else if(tipo == 'BACHILLERATO TÉCNICO'){
                if(id_escuela > 0 && id_escuela < 21){ //ES UN CECYT
                    $("#nombre_escuela").css("display","none"); //OCULTAMOS LOS CAMPOS QUE NO VAMOS A OCUPAR
                    $("#input_formacion_tecnica").css("display","none");
                    $("#localidad").prop("readonly", true);
                    cambiarEscuelas(tipo);
                    cambiarCarreras(id_escuela);
                    //no cambia los valores de los select
                    $("#escuelas").formSelect();
                    $("#escuelas").val("<?php echo $id_escuela; ?>");
                    $("#escuelas").formSelect();
                    $("#formacion_tecnica").formSelect();
                    $("#formacion_tecnica").val('<?php echo $nombre_formacion_tecnica; ?>');
                    $("#formacion_tecnica").formSelect(); 
                }
                else{ // NO ES UN CECYT
                    $("#box_escuela_1").css("display","none"); //OCULTAMOS LOS CAMPOS QUE NO VAMOS A OCUPAR
                    $("#box_formacion_tecnica").css("display","none"); 
                    $("#nombre_Escuela").val('<?php echo $nombre_escuela; ?>');
                    $("#formacion_tecnica2").val('<?php echo $nombre_formacion_tecnica; ?>');
                }

            }

            
            if(tipo == 'BACHILLERATO EN LÍNEA'){
                if(id_escuela == 10){ //CECYT 9 POLIVIRTUAL
                    $("#nombre_escuela").css("display","none"); //OCULTAMOS LOS CAMPOS QUE NO VAMOS A OCUPAR
                    $("#input_formacion_tecnica").css("display","none");
                    $("#box_formacion_tecnica").css("display","none");
                    $("#localidad").prop("readonly", true);
                    cambiarEscuelas(tipo);
                    //no cambia los valores de los select
                    $("#escuelas").val("<?php echo $id_escuela; ?>");
                    $("#escuelas").formSelect();
                }

                else{
                    $("#box_escuela_1").css("display","none"); //OCULTAMOS LOS CAMPOS QUE NO VAMOS A OCUPAR
                    $("#box_formacion_tecnica").css("display","none");
                    $("#input_formacion_tecnica").css("display","none");
                    $("#nombre_Escuela").val('<?php echo $nombre_escuela; ?>');
                }

            }

            $("#grupo").val("<?php echo $grupo_alumno; ?>");
            $("#grupo").formSelect();

            $("#genero").val("<?php echo $genero; ?>");
            $("#genero").formSelect();

            $("#bachillerato").val("<?php echo $tipo; ?>");
            $("#bachillerato").formSelect();

            $("#programaacad").val("<?php echo $programa_academico; ?>");
            $("#programaacad").formSelect();

            M.updateTextFields();
        });
    }

    function cambiarEscuelas(bachillerato) {
        $.ajax({
            url: "../../../php/formulario/escuelas.php",
            cache: false,
            method: "POST",
            data: {bachillerato: bachillerato},
            success: function (escuelas) {

                let AX = JSON.parse(escuelas);

                if (bachillerato == "BACHILLERATO TÉCNICO") {
                    for (i = 0; i < AX.length; i++) {
                        if ((i + 1) < AX.length) {
                            if (<?php echo $id_escuela; ?> == (i + 1)) {
                                $('#escuelas').append($('<option value="' + (i + 1) + '" selected>' + AX[i] + '</option>'));    
                            }
                            else {
                                $('#escuelas').append($('<option value="' + (i + 1) + '">' + AX[i] + '</option>'));
                            }
                        } else {
                            $('#escuelas').append($('<option value="' + "OTRA" + '">' + AX[i] + '</option>'));
                        }
                    }
                    $('#escuelas').formSelect();
                } else if (bachillerato == "BACHILLERATO EN LÍNEA") {
                    if ("<?php echo $id_escuela; ?>" == "10") {
                        $('#escuelas').append($('<option value="' + "10" + '" selected>' + AX[0] + '</option>'));
                        $('#escuelas').append($('<option value="' + "OTRA" + '">' + AX[1] + '</option>'));
                    }
                    else {
                        $('#escuelas').append($('<option value="' + "10" + '">' + AX[0] + '</option>'));
                        $('#escuelas').append($('<option value="' + "OTRA" + '" selected>' + AX[1] + '</option>'));
                    }
                    
                    $('#escuelas').formSelect();
                }
            }
        });
    }
    function cambiarCarreras(escuela) {
        $.ajax({
            url: "../../../php/formulario/carreras.php",
            method: "POST",
            cache: false,
            data: {escuela: escuela},
            success: function (carreras) {
                let AX = JSON.parse(carreras);
                for (i = 0; i < AX.length; i++) {
                    if ("<?php echo $nombre_formacion_tecnica; ?>" == AX[i])
                    $('#formacion_tecnica').append($('<option value="' + AX[i] + '" selected>' + AX[i] + '</option>'));
                    else
                        $('#formacion_tecnica').append($('<option value="' + AX[i] + '">' + AX[i] + '</option>'));
                }
                $('#formacion_tecnica').formSelect();
            }
        });
    }

    function cambiarUbicacion(escuela) {
        $.ajax({
            url: "../../../php/formulario/ubicacion.php",
            method: "POST",
            cache: false,
            data: {
                escuela: escuela
            },
            success: function (ubicacion) {
                var localidad = document.getElementById("localidad");
                localidad.value = ubicacion;
                let parent = $("#localidad").parent();
                if(parent.hasClass("validetta-error") == true){
                    parent.removeClass("validetta-error");
                    parent.find("span.validetta-bubble").remove();
                }
                M.updateTextFields();
            }
        });
    }

    function cambiarSelect() {
        var bachillerato = $("#bachillerato").val();
        if (bachillerato == 'BACHILLERATO TÉCNICO') {
            $("#box_escuela_1").css("display", "block");
            $("#nombre_escuela").css("display", "none");
            $("#box_formacion_tecnica").css("display", "none");
            $("#input_formacion_tecnica").css("display", "none");
            $("#localidad").prop("readonly", true);
            cambiarEscuelas(bachillerato);
        } else if (bachillerato == 'BACHILLERATO GENERAL') {
            $("#nombre_escuela").css("display", "block");
            $("#box_escuela_1").css("display", "none");
            $("#box_formacion_tecnica").css("display", "none");
            $("#input_formacion_tecnica").css("display", "none");
            $("#localidad").prop("readonly", false);
        } else if (bachillerato == 'BACHILLERATO EN LÍNEA') {
            $("#nombre_escuela").css("display", "none");
            $("#box_escuela_1").css("display", "block");
            $("#box_formacion_tecnica").css("display", "none");
            $("#input_formacion_tecnica").css("display", "none");
            $("#localidad").prop("readonly", true);
            cambiarEscuelas(bachillerato);
        }
    }

    function mismoSelect(esc, n) {
        if (esc != "OTRA") {
            $("#nombre_escuela").css("display", "none");
            $("#localidad").prop("readonly", true);
            M.updateTextFields();
            if (n == 1) {
                $("#box_formacion_tecnica").css("display", "block");
                $("#input_formacion_tecnica").css("display", "none");
            }
            cambiarUbicacion(esc);
        } else {
            M.updateTextFields();
            $("#localidad").prop("readonly", false);
            $("#nombre_escuela").css("display", "block");
            if (n == 1) {
                $("#box_formacion_tecnica").css("display", "none");
                $("#input_formacion_tecnica").css("display", "block");
            }
        }
    }

    function resetCarreras() {
        var num_carreras = document.getElementById("formacion_tecnica");
        if (num_carreras.length > 1) {
            num_carreras.length = 1;
        }
    }

    function resetEscuelas() {
        var num_escuelas = document.getElementById("escuelas");
        if (num_escuelas.length > 1) {
            num_escuelas.length = 1;
        }
    }

    function mayuscula(e){
        e.value = e.value.toUpperCase();
    }

    /**
     * Elimina al alumno
     */
    $("#btnDelete").click(function(e) {
        e.preventDefault();
    });

    /**
     * Previene el submit del form, pero sigue validando y requiriendo los controles necesarios
     */
    $("form").submit(function(e){
        e.preventDefault();
    });

    /**
     * Función llamada desde la propiedad onValid de validetta
     */
    function submitForm() {
        var curp = $("#curp").val();

        // grupo y aciertos
        var grupo = $("#grupo").val();
        var aciertos = $("#aciertos").val();

        $.ajax({
            url: "./group_score.php",
            method: "POST",
            cache: false,
            data: {curp: curp, grupo: grupo, aciertos: aciertos},
            success: function (respax) {
                console.log(respax);
            }
        });

        // información personal
        var nombre = $("#nombre").val();
        var apepat = $("#apellidopat").val();
        var apemat = $("#apellidomat").val();
        var genero = $("#genero").val();
        var fechanac = $("#fecha-nac").val();
        var email = $("#email").val();
        var telcelular = $("#telcelular").val();
        var telfijo = $("#telfijo").val();
        var direccion = $("#direccion").val();
        
        $.ajax({
            url: "./personal_info.php",
            method: "POST",
            cache: false,
            data: {curp: curp, nombre: nombre, apepat: apepat, apemat: apemat, genero: genero, fechanac: fechanac, email: email,
                telcelular: telcelular, telfijo: telfijo, direccion: direccion},
            success: function (respax) {
                console.log(respax);
            }
        });

        // programa academico
        var semestre = $("#semestre").val();
        var programaacad = $("#programaacad").val();
        var opcion = $("#opcion").val();

        $.ajax({
            url: "./programa_acad.php",
            method: "POST",
            cache: false,
            data: {curp:curp, semestre: semestre, programaacad: programaacad, opcion: opcion},
            success: function (respax) {
                console.log(respax);
            }
        });

        // escuela
        var newEscuela = $("#escuela_nuevo").val();

        var escuela = $("#nombre_Escuela").val();
        var tipoBach = $("#bachillerato").val();
        switch (tipoBach) {
            case BACH_TEC:
                if (newEscuela != "")
                    actualizarBachTec(curp);
                break;

            default:
                if (tipoBach == BACH_LIN && newEscuela == "10") {
                    actualizarEscuela(curp, newEscuela, tipoBach);
                    escuela = "";
                }
                if (escuela != "")
                    actualizarEscuela(curp, escuela, tipoBach);
                break;
        }

        location.reload();
    }

    $("#escuelas").on('change', function(){
        $("#escuela_nuevo").val(this.value);
    });

    function updateSchool() {
        $("#escuela_nuevo").val($("#escuelas").val());
    }

    function actualizarBachTec(curp) {
        var escuela = $("#escuela_nuevo").val();
        var formacion = $("#formacion_tecnica").val();

        $.ajax({
            url: "./cambio_tec.php",
            method: "POST",
            cache: false,
            data: {curp: curp, escuela: escuela, formacion: formacion, promedio: $("#promedio").val()},
            success: function(respax) {
                console.log(respax);
            }
        });
    }

    function actualizarEscuela(curp, escuela, tipo) {
        var localidad = $("#localidad").val();
        var promedio = $("#promedio").val();

        $.ajax({
            url: "./cambio_esc.php",
            method: "POST",
            cache: false,
            data: {curp: curp, nombre_escuela: escuela, promedio: promedio, localidad: localidad, tipo: tipo},
            success: function(respax) {
                console.log(respax);
            }
        });
    }

</script>
