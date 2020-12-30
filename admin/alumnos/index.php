<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin - Alumnos</title>
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
                    <li><a href="../../">Salir</a></li>
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
                    <li>
                        <div class="divider"></div>
                    </li>

                    <div class="sidenav-buttons">
                        <div class="blue lighten-5">
                            <li><a class="waves-effect blue-text" href="./alumnos.html">Alumno</a></li>
                        </div>
                        <li><a class="waves-effect" href="../reportes.html">Reportes</a></li>
                    </div>
                </ul>

            </div>
        </div>

        <!-- Dashboard -->
        <div class="container">
            <div class="row header-dashboard-students">
                <div class="col s12 m6 l6">
                    <h4>Registro de alumnos</h4>
                </div>
                <div class="col s12 m6 l6 new-button-dashboard">
                    <!-- Modal trigger -->
                    <button class="waves-effect waves-light btn white blue-text modal-trigger"
                        data-target="modalNuevoAlumno">Nuevo</button>
                </div>
                <!-- Modal Structure -->
                <div id="modalNuevoAlumno" class="modal">
                    <div class="modal-content">
                        <h4>Añadir nuevo alumno</h4>

                        <div class="row">
                            <form class="col s12">
                                <div class="row modal-form-row">
                                    <div class="input-field col s12">
                                        <input id="txtNombre" type="text" class="validate">
                                        <label for="txtNombre">Nombre(s)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="txtApellidoPat" type="text" class="validate">
                                        <label for="txtApellidoPat">Apellido paterno</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="txtApellidoMat" type="text" class="validate">
                                        <label for="txtApellidoMat">Apellido materno</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class=" modal-action modal-close waves-effect waves-green btn-flat">Añadir</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col l12 m12 s12">
                    <input type="text" id="txtBuscar" onkeyup="filtrar()" placeholder="Buscar...">
                </div>
            </div>

            <table id="tblAlumnos" class="striped responsive-table">
                <thead>
                    <tr>
                        <th>CURP</th>
                        <th>Nombre</th>
                        <th>Registro</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Aca iran las iteraciones con php -->
                    <?php
                    include '../../php/db.php';
                    $conn = open_database();

                    $query = "SELECT curp, nombre, primer_apellido AS apellidopat, segundo_apellido AS apellidomat, fecha_registro AS fecha FROM Alumno ORDER BY fecha DESC";
                    $result = mysqli_query($conn, $query);
                    mysqli_close($conn);

                    if (mysqli_num_rows($result) == 0) {
                    ?>
                    <tr>
                        <td>-</td>
                        <td>Sin registros disponibles</td>
                        <td>-</td>
                    </tr>
                    <?php
                    }
                    else
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td class="truncate"><p class="grey-text"><?php echo $row["curp"]; ?></p></td>
                        <td><a href="#" onclick="editar(this)" class="truncate"><?php echo $row["nombre"] . " " . $row["apellidopat"] . " " . $row["apellidomat"]; ?></a></td>
                        <td><?php echo $row["fecha"]; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <!-- <tr>
                        <td><a href="#" onclick="editar(this)">Juana Sánchez</a></td>
                        <td>13-20-20 11:00:00AM</td>
                    </tr>
                    <tr>
                        <td><a href="#" onclick="editar(this)">Carlos Martínez</a></td>
                        <td>15-20-20 9:00:00AM</td>
                    </tr> -->
                </tbody>
            </table>
        </div>

        <div class="container right-align" style="padding-top: 20px;">
            Exportar como <br>
            <a href="#" class="waves-effect waves-light blue btn">CSV</a>
        </div>

    </main>

    <!-- Form escondido para poder obtener los datos necesarios para editar posteriormente -->
    <form action="./editar.html" hidden>
        <!-- En lugar de su nombre tendra que ser su clave de registro o boleta -->
        <input type="text" name="txtName" id="txtName">
        <button class="btn waves-effect waves-light" type="submit" name="action" id="btnEditSubmit">Submit
            <i class="material-icons right">send</i>
        </button>
    </form>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
    });

    function filtrar() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("txtBuscar");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblAlumnos");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function editar(a) {
        
        // document.getElementById("txtName").value = a.innerHTML;
        // document.getElementById("btnEditSubmit").click();
    }
</script>