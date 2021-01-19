<?php

session_start();
if (!isset($_SESSION["id"])) {
    header("location:../");
    exit;
}

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
                    <li><a href="#">Acerca de</a></li>
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

        <!-- Dashboard -->
        <div class="container">
            <div class="row header-dashboard-students">
                <div class="col s12 m6 l6">
                    <h4>Registro de grupos</h4>
                </div>
                <div class="col s12 m6 l6 new-button-dashboard">
                    <!-- Modal trigger -->
                    <button class="waves-effect waves-light btn white blue-text modal-trigger"
                        data-target="modalNuevoGrupo">Nuevo</button>
                </div>
                <!-- Modal Structure -->
                <div id="modalNuevoGrupo" class="modal">
                    <form class="col s12" id="nuevo">
                        <div class="modal-content">
                            <h4>Añadir nuevo grupo</h4>

                            <div class="row">
                                <div class="row modal-form-row">
                                    <div class="input-field col s12">
                                        <input id="txtClave" type="text" class="validate" data-validetta="regExp[clave]" required>
                                        <label for="txtClave">Clave</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="txtFecha" type="text" class="validate" data-validetta="regExp[fecha]" required>
                                        <label for="txtFecha">Fecha</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="txtHorario" type="text" class="validate" data-validetta="regExp[horario]" required>
                                        <label for="txtHorario">Horario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="txtCupo" type="text" class="validate" value="20" data-validetta="regExp[cupo]" required>
                                        <label for="txtCupo">Cupo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Añadir">
                        </div>
                    </form>
                </div>
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
                    include '../../php/db.php';
                    $conn = open_database();

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
                                    <input id="horario" type="text" class="validate" required>
                                </div>
                            </div>
                            <div class="row">
                                <label>Cupo</label>
                                <div class="input-field col s12">
                                    <input id="cupo" type="text" class="validate" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="modal-action waves-effect waves-green btn-flat" type="submit" value="Guardar">
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
    <script src="./index.js"></script>
</div>

</html>

<script>
    
</script>