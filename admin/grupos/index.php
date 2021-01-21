<?php

session_start();
if (!isset($_SESSION["id"])) {
    header("location:../");
    exit;
}

//         $horas = array("10:00:00","12:00:00","14:00:00","16:00:00");
//         $grupos = array("1101","1102","1103","1104","1105");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin - Grupos</title>
    <meta name='viewport'
        content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no' />
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <!-- Validetta -->
    <link rel="stylesheet" href="../../css/validetta.min.css">
    <!-- local styles -->
    <link rel="stylesheet" href="../../css/admin.css">
    <!-- Jquery Confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
</head>

<body>
    <header>
        <!-- Top navbar -->
        <nav>
            <div class="nav-wrapper blue">
                <div class="menu-button">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i
                            class="material-icons">menu</i></a>
                </div>
                <ul id="nav-mobile" class="right">
                    <li><a href="../logout.php?nombreSesion=id">Salir</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <!-- Side navbar -->
        <div class="row">
            <div class="container">

                <ul id="slide-out" class="side-nav fixed">
                    <li>
                        <div class="user-view">
                            <div class="sidenav-header center">Admin</div>
                        </div>
                    </li>
                    <li><div class="divider"></div></li>
                    
                    <div class="sidenav-buttons">
                        <li><a class="waves-effect" href="../alumnos/">Alumno</a></li>
                        <li><a class="waves-effect" href="../reportes/">Reportes</a></li>
                        <div class="blue lighten-5">
                            <li><a class="waves-effect blue-text" href="./">Grupos</a></li>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

        <!-- Dias -->
        <div class="container">
            <div class="row header-dashboard-students">
                <div class="col s12 m6 l6">
                    <h5>Días en el que se llevará el examen</h5>
                </div>
                <div class="col s12 m6 l6 new-button-dashboard">
                    <!-- Modal trigger -->
                    <button class="waves-effect waves-light btn white blue-text modal-trigger"
                        data-target="modalNuevoDia">Añadir</button>
                </div>
                <!-- Modal Structure -->
                <div id="modalNuevoDia" class="modal">
                    <form class="col s12" id="newDay">
                        <div class="modal-content">
                            <h4>Añadir nuevo día</h4>

                            <div class="row modal-form-row">
                                <div class="input-field col s12">
                                    <input id="txtDate" type="text" class="validate" data-validetta="regExp[date]" required>
                                    <label for="txtDate">Fecha</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Añadir">
                        </div>
                    </form>
                </div>

                <table id="tblDias" class="striped">
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include '../../php/db.php';
                        $conn = open_database();

                        $query = "SELECT fecha FROM Dia ORDER BY fecha DESC";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 0) {
                        ?>
                        <tr>
                            <td>Sin registros disponibles</td>
                            <td>-</td>
                        </tr>
                        <?php
                        }
                        else
                            while ($row = mysqli_fetch_array($result)) {
                                $fecha = $row["fecha"];
                        ?>
                        <tr>
                            <td><?php echo $fecha; ?></td>
                            <td><a href="javascript:void(0)" onclick="eliminarDia(this)"> <i class="material-icons">delete_forever</i> </a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Horarios -->
        <div class="container">
            <div class="row header-dashboard-students">
                <div class="col s12 m6 l6">
                    <h5>Horarios en el que se llevará el examen</h5>
                </div>
                <div class="col s12 m6 l6 new-button-dashboard">
                    <!-- Modal trigger -->
                    <button class="waves-effect waves-light btn white blue-text modal-trigger"
                        data-target="modalNuevoHorario">Añadir</button>
                </div>
                <!-- Modal Structure -->
                <div id="modalNuevoHorario" class="modal">
                    <form class="col s12" id="newHorario">
                        <div class="modal-content">
                            <h4>Añadir nueva hora</h4>

                            <div class="row modal-form-row">
                                <div class="input-field col s12">
                                    <input id="txtHora" type="text" class="validate" placeholder="Ejemplo: 09:00" data-validetta="regExp[hora]" required>
                                    <label for="txtHora">Hora</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Añadir">
                        </div>
                    </form>
                </div>

                <table id="tblHoras" class="striped">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = "SELECT hora FROM Horario";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 0) {
                        ?>
                        <tr>
                            <td>Sin registros disponibles</td>
                            <td>-</td>
                        </tr>
                        <?php
                        }
                        else
                            while ($row = mysqli_fetch_array($result)) {
                                $hora = $row["hora"];
                        ?>
                        <tr>
                            <td><?php echo $hora; ?></td>
                            <td><a href="javascript:void(0)" onclick="eliminarHorario(this)"> <i class="material-icons">delete_forever</i> </a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Edificios -->
        <div class="container">
            <div class="row header-dashboard-students">
                <div class="col s12 m6 l6">
                    <h5>Edificios en los que se llevará el examen</h5>
                </div>
                <div class="col s12 m6 l6 new-button-dashboard">
                    <!-- Modal trigger -->
                    <button class="waves-effect waves-light btn white blue-text modal-trigger"
                        data-target="modalNuevoEdificio">Añadir</button>
                </div>
                <!-- Modal Structure -->
                <div id="modalNuevoEdificio" class="modal">
                    <form class="col s12" id="newEdificio">
                        <div class="modal-content">
                            <h4>Añadir nuevo edificio</h4>

                            <div class="row modal-form-row">
                                <div class="input-field col s12">
                                    <input id="txtEdificio" type="text" class="validate" placeholder="Ejemplo: 1100" data-validetta="regExp[clave]" required>
                                    <label for="txtEdificio">Edificio</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Añadir">
                        </div>
                    </form>
                </div>

                <table id="tblHoras" class="striped">
                    <thead>
                        <tr>
                            <th>Edificio</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = "SELECT edificio FROM Edificio";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 0) {
                        ?>
                        <tr>
                            <td>Sin registros disponibles</td>
                            <td>-</td>
                        </tr>
                        <?php
                        }
                        else
                            while ($row = mysqli_fetch_array($result)) {
                                $edificio = $row["edificio"];
                        ?>
                        <tr>
                            <td><?php echo $edificio; ?></td>
                            <td><a href="javascript:void(0)" onclick="eliminarEdifico(this)"> <i class="material-icons">delete_forever</i> </a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container" style="padding: 15px;">
        <hr>
        </div>

        <!-- Dashboard -->
        <div class="container">
            <div class="row header-dashboard-students">
                <h4>Registro de grupos</h4>
            </div>

            <div class="row">
                <div class="col l12 m12 s12">
                    <input type="text" id="txtBuscar" placeholder="Buscar...">
                </div>
            </div>

            <table id="tblGrupos" class="striped responsive-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Horario</th>
                        <th>Cupo</th>
                        <th>Inscritos</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = "SELECT clave, horario, cupo FROM Grupo ORDER BY horario DESC";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) == 0) {
                    ?>
                    <tr>
                        <td>-</td>
                        <td>Sin registros disponibles</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <?php
                    }
                    else
                        while ($row = mysqli_fetch_array($result)) {
                            $clave = $row["clave"];
                            $horario = $row["horario"];
                            $cupo = $row["cupo"];

                            $query_inscritos = "SELECT COUNT(*) AS inscritos FROM Alumno_has_grupo WHERE clave_grupo = '$clave'";
                            $result_inscritos = mysqli_query($conn, $query_inscritos);
                            $inscritos = mysqli_fetch_array($result_inscritos)[0];
                    ?>
                    <tr>
                        <td><a href="javascript:void(0)" onclick="editar(this)"><?php echo $clave; ?></a></td>
                        <td><?php echo $horario; ?></td>
                        <td><?php echo $cupo; ?></td>
                        <td><?php echo $inscritos; ?></td>
                    </tr>
                    <?php
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Edit modal -->
        <div>
            <!-- Modal Trigger -->
            <div hidden>
                <a id="showEditGroup" class="waves-effect waves-light btn modal-trigger" href="#editModal" hidden>Modal</a>
            </div>

            <!-- Modal Structure -->
            <div id="editModal" class="modal">
                <form class="col s12" id="editar">
                    <div class="modal-content">
                        <h4>Editar grupo</h4>

                        <div class="row">
                            <div class="row modal-form-row">
                                <label>Clave</label>
                                <div class="input-field col s12">
                                    <input id="clave" type="text" class="validate" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label>Horario</label>
                                <div class="input-field col s12">
                                    <input id="horario" type="text" class="validate" data-validetta="regExp[fechahorario]" required>
                                </div>
                            </div>
                            <div class="row">
                                <label>Cupo</label>
                                <div class="input-field col s12">
                                    <input id="cupo" type="text" class="validate" data-validetta="regExp[cupo]" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col s6">
                                <a id="eliminarGrupo" class="waves-effect waves-light btn white red-text">Eliminar</a>
                            </div>
                            <div class="col s6">
                                <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Guardar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>

<div class="scripts">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <!-- Validetta -->
    <script src="../../js/validetta.min.js"></script>
    <!-- JQuery Confirm -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="./index.js"></script>
</div>

</html>

<script>
    $(document).ready(function () {
        intializeNewDay();
        intializeValidationNewHour();
        intializeValidationNewEdificio();
    })

    /**
     * Función que inicializa los controles para añadir un nuevo día
     */
    function intializeNewDay() {
        validateNewDay();
        var today = new Date();
        var todayStr = today.getFullYear() + "-" + pad(today.getMonth() + 1, 2) + "-" + pad(today.getDate(), 2);
        $("#txtDate").val(todayStr);
    }

    function intializeValidationNewHour() {
        $("#newHorario").validetta({
            validators: {
                regExp: {
                    hora: {
                        pattern: /^(0{1}\d{1}|1{1}\d{1}|2{1}[0-3]{1}):[0-5]{1}\d{1}$/,
                        errorMessage: "Horario no valido (formato 24 hrs)"
                    }
                }
            },
            realTime : true,
            bubblePosition: 'bottom',
            onValid : function (e) {
                e.preventDefault();
                submitNewHour();
            },
            onError : function (e) {
                // e.preventDefault();
                alert("No todos los campos son validos");
            }
        });
    }

    function intializeValidationNewEdificio() {
        $("#newEdificio").validetta({
            validators: {
                regExp: {
                    clave: {
                        pattern: /^\d{1,4}$/,
                        errorMessage: "Rango aceptado [0, 9999]"
                    }
                }
            },
            realTime : true,
            bubblePosition: 'bottom',
            onValid : function (e) {
                e.preventDefault();
                submitNewEdificio();
            },
            onError : function (e) {
                // e.preventDefault();
                alert("No todos los campos son validos");
            }
        });
    }

    /**
     * Función que inicializa las validaciones del form newDay
     */
    function validateNewDay() {
        $("#newDay").validetta({
            validators: {
                regExp: {
                    date: {
                        pattern: /^(2[0-1][2-9]\d)-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/,
                        errorMessage: "Fecha no valida"
                    }
                }
            },
            realTime : true,
            bubblePosition: 'bottom',
            onValid : function (e) {
                e.preventDefault();
                submitNewDay();
            },
            onError : function (e) {
                // e.preventDefault();
                alert("No todos los campos son validos");
            }
        });
    }

    /**
     * Ingresa un nuevo dia a la base de datos
     */
    function submitNewDay() {
        $.ajax({
            url: "./insertDia.php",
            method: "POST",
            cache: false,
            data: {fecha: $("#txtDate").val()},
            success: function (respax) {
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

    function submitNewHour() {
        $.ajax({
            url: "./insertHora.php",
            method: "POST",
            cache: false,
            data: {hora: $("#txtHora").val()},
            success: function (respax) {
                console.log(respax);
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

    function submitNewEdificio() {
        $.ajax({
            url: "./insertEdificio.php",
            method: "POST",
            cache: false,
            data: {edificio: pad(parseInt($("#txtEdificio").val()), 4)},
            success: function (respax) {
                console.log(respax);
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

    /**
     * Elimina el día que el ususario clickea
     */
    function eliminarDia(a) {
        var tableAux = a.parentNode.parentNode.parentNode.parentNode;
        var rowNumber = a.parentNode.parentNode.rowIndex;

        var fecha = tableAux.rows[rowNumber].cells[0].innerHTML;
        $.ajax({
            url: "deleteDia.php",
            cache: false,
            method: "POST",
            data: {fecha: fecha},
            success: function (respax) {
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

    $("#eliminarGrupo").click(function (e) {
        e.preventDefault();
        // confirma con JQuery Confirm
        $.confirm({
            backgroundDismiss: true,
            title: '¡Atención!',
            content: '¿Está seguro de querer borrar el grupo ' + $("#clave").val() + '?',
            buttons: {
                Confirmar: {
                    text: 'Eliminar',
                    btnClass: 'btn-red',
                    action: eliminarGrupo
                },
                Cancelar: {
                    btnClass: 'white blue-text'
                }
            }
        });
    });

    /**
     * Elimina al grupo previa confirmación
     */
    function eliminarGrupo() {
        $.ajax({
            url: "delete.php",
            method: "POST",
            cache: false,
            data: {clave: $("#clave").val()},
            success: function (respax) {
                if (respax == "true")
                    window.location.reload();
                else
                    alert(respax);
            }
        });
    }

    function eliminarHorario(a) {
        var tableAux = a.parentNode.parentNode.parentNode.parentNode;
        var rowNumber = a.parentNode.parentNode.rowIndex;

        var hora = tableAux.rows[rowNumber].cells[0].innerHTML;
        $.ajax({
            url: "deleteHora.php",
            cache: false,
            method: "POST",
            data: {hora: hora},
            success: function (respax) {
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

    function eliminarEdifico(a) {
        var tableAux = a.parentNode.parentNode.parentNode.parentNode;
        var rowNumber = a.parentNode.parentNode.rowIndex;

        var edificio = tableAux.rows[rowNumber].cells[0].innerHTML;
        $.ajax({
            url: "deleteEdificio.php",
            cache: false,
            method: "POST",
            data: {edificio: edificio},
            success: function (respax) {
                if (respax == "true") {
                    window.location.reload();
                }
                else {
                    alert(respax);
                }
            }
        });
    }

</script>