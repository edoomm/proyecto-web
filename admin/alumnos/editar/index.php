<?php

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
                        <li><a href="#">Salir</a></li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <form id="studentData">
            <div class="container" style="padding-top: 10px;">
                <div class="row">
                    <div class="col l6 m6 s12">
                        <label for="grupo">Grupo</label>
                        <select id="grupo">
                            <option value="" selected>Sin grupo asignado</option>
                        </select>
                    </div>
                    <div class="col l6 m6 s12">
                        <label for="aciertos">Aciertos</label>
                        <input type="text" name="aciertos" id="aciertos" data-validetta="regExp[aciertos]">
                    </div>
                </div>
            </div>

            <ul class="collapsible expandable">
                <!-- Datos personales -->
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">person</i>Datos personales</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row input-field">
                                <label for="curp">CURP</label>
                                <input type="text" name="curp" id="curp" disabled value="<?php echo $curp; ?>">
                            </div>
                            <div class="row input-field">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s12 input-field">
                                    <label for="apellidopat">Primer apellido</label>
                                    <input type="text" name="apellidopat" id="apellidopat" value="<?php echo $primer_apellido; ?>">
                                </div>
                                <div class="col l6 m6 s12 input-field">
                                    <label for="apellidomat">Segundo apellido</label>
                                    <input type="text" name="apellidomat" id="apellidomat" value="<?php echo $segundo_apellido; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l6 input-field">
                                    <label for="fecha-nac">Fecha de nacimiento</label>
                                    <input type="text" class="datepicker" id="fecha-nac" name="fecha-nac">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <select id="genero">
                                        <option value="" disabled selected>G&eacute;nero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="N">No binario</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row input-field">
                                <label for="correo">Correo electronico</label>
                                <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>">
                            </div>
                            <div class="row">
                                <div class="col l6 m6 s12 input-field">
                                    <label for="telfijo">Teléfono fijo</label>
                                    <input type="text" name="telfijo" id="telfijo" value="<?php echo $telefono_casa; ?>">
                                </div>
                                <div class="col l6 m6 s12 input-field">
                                    <label for="telcelular">Teléfono celular</label>
                                    <input type="text" name="telcelular" id="telcelular" value="<?php echo $telefono_celular; ?>">
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
                                <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>">
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Escuela de procedencia -->
                <li>
                    <div class="collapsible-header"><i class="material-icons">school</i>Escuela de procedencia</div>
                    <div class="collapsible-body">
                        <div class="form-field">
                            <div class="row input-field">
                                <label for="nombreEscuela">Nombre de la escuela</label>
                                <input type="text" name="nombreEscuela" id="nombreEscuela">
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <select id="bachillerato">
                                    <option value="0" disabled selected>Tipo de bachillerato</option>
                                    <option value="1">Bachillerato general</option>
                                    <option value="2">Bachillerato t&eacute;cnico</option>
                                    <option value="3">Bachillerato en l&iacute;nea</option>
                                </select>
                            </div>
                            <div class="row input-field">
                                <label for="localidad">Localidad</label>
                                <input type="text" name="localidad" id="localidad">
                            </div>
                            <div class="row input-field">
                                <label for="promedio">Promedio</label>
                                <input type="text" name="promedio" id="promedio">
                            </div>
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
                                <input type="text" name="semestre" id="semestre">
                            </div>
                            <div class="row input-field">
                                <label for="programaacad">Programa academico</label>
                                <input type="text" name="programaacad" id="programaacad">
                            </div>
                            <div class="row input-field">
                                <label for="opción">Opción</label>
                                <input type="text" name="opción" id="opción">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="form-field">
                <button class="btn-large waves-effect waves-dark blue" style="width: 100%;">Guardar</button>
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
    $(document).ready(function(){
        // Intializing controls
        $('.collapsible').collapsible();
        var elem = document.querySelector('.collapsible.expandable');
        var instance = M.Collapsible.init(elem, {
            accordion: false
        });
        $('select').formSelect();

        // Intializing datepicker
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
            defaultDate: new Date(2000, 0, 1),
            setDefaultDate: true,
            i18n: {
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            }
        });
        // Student info
        $('#fecha-nac').val("<?php echo $fecha_nacimiento; ?>");
        $("#genero").val("<?php echo $genero; ?>");
        $("#genero").formSelect();

        cargarDatos();

        M.updateTextFields();

        // validetta
        $("#studentData").validetta({
            validators: {
                regExp: {
                    aciertos : {
                        pattern: /10|([0-9](.[0-9]{1,2}){1})/,
                        errorMessage: "Aciertos no validos"
                    }
                }
            }
        });
    });

    function cargarDatos() {
        // jQuery(function($) {
        //     $('#curp').val("<?php echo $curp; ?>");
        //     $('#nombre').val("<?php echo $nombre; ?>");
        // });
    }

    $("#btnDelete").click(function(e) {
        e.preventDefault();
    })
</script>
