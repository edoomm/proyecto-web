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
                            <li><a class="waves-effect blue-text" href="../alumnos/">Alumno</a></li>
                        </div>
                        <li><a class="waves-effect" href="../reportes/">Reportes</a></li>
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
                    <input type="text" id="txtBuscar" placeholder="Buscar...">
                </div>
            </div>

            <table id="tblAlumnos" class="striped responsive-table">
                <thead>
                    <tr>
                        <th>CURP</th>
                        <th>Nombre</th>
                        <th>Registro</th>
                        <th>Grupo</th>
                        <th>Aciertos</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include '../../php/db.php';
                    $conn = open_database();

                    $query = "SELECT curp, nombre, primer_apellido AS apellidopat, segundo_apellido AS apellidomat, fecha_registro AS fecha FROM Alumno ORDER BY fecha DESC";
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
                            $curp = $row["curp"];
                            $grupo = "-";
                            $aciertos = "-";

                            // retrieving grupo & aciertos
                            $query_grupo = "SELECT clave_grupo, aciertos FROM Alumno_has_Grupo WHERE curp_alumno = '$curp'";
                            $result_grupo = mysqli_query($conn, $query_grupo);
                            if (mysqli_num_rows($result_grupo) != 0) {
                                $rowAG = mysqli_fetch_array($result_grupo);

                                $grupo = $rowAG["clave_grupo"];
                                $aciertos = $rowAG["aciertos"];
                            }
                    ?>
                    <tr>
                        <td><?php echo $curp; ?></td>
                        <td><a href="javascript:void(0)" onclick="editar(this)"><?php echo $row["nombre"] . " " . $row["apellidopat"] . " " . $row["apellidomat"]; ?></a></td>
                        <td><p class="grey-text"><?php echo $row["fecha"]; ?></p></td>
                        <td><?php echo $grupo; ?></td>
                        <td><?php echo $aciertos; ?></td>
                    </tr>
                    <?php
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>

    </main>

    <!-- Form escondido para poder obtener los datos necesarios para editar posteriormente -->
    <form method="POST" action="./editar/" hidden>
        <!-- En lugar de su nombre tendra que ser su clave de registro o boleta -->
        <input type="text" name="txtCurp" id="txtCurp">
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

        // Searching in table
        $('#txtBuscar').keyup(function(){
            search_table($(this).val());
        });
        function search_table(value){
        $('#tblAlumnos tbody tr').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                    found = 'true';
            });
            if(found == 'true')
                $(this).show();
            else
                $(this).hide();
        });
        // This function makes a responsive bug

        $('#trSts').show();
        }
    });

    // Bug fixer
    $(window).on('resize', function(){
        $("#tblAlumnos").load("index.php #tblAlumnos");
    });

    function editar(a) {
        var tableAux = a.parentNode.parentNode.parentNode.parentNode;
        var rowNumber = a.parentNode.parentNode.rowIndex;
        var curp = tableAux.rows[rowNumber].cells[0].innerHTML;

        $("#txtCurp").val(curp);
        $("#btnEditSubmit").click();

        return false;
    }
</script>