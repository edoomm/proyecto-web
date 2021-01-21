<?php

    session_start();
    if (!isset($_SESSION["id"])) {
        header("location:../");
        exit;
    }

    include "./general.php";
    include "./escuelas_procedencia.php";
    include "./aciertos_obtenidos.php";
    include "./opcion.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Admin - Reportes</title>
    <meta name='viewport'
        content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no' />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <!-- Materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <!-- local styles -->
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"/>
    <link rel="stylesheet" href="./reportes.css">
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
                    <li>
                        <div class="divider"></div>
                    </li>

                    <div class="sidenav-buttons">
                        <li><a class="waves-effect" href="../alumnos/">Alumno</a></li>
                        <div class="blue lighten-5">
                            <li><a class="waves-effect blue-text" href="./">Reportes</a></li>
                        </div>
                        <li><a class="waves-effect" href="../grupos/">Grupos</a></li>
                    </div>
                </ul>
            </div>
        </div>

        <div class="row">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header">
                        <i class="fas fa-users"></i>General</div>
                    <div class="collapsible-body">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th>Programa Acad&eacute;mico</th>
                                    <th>No. de Alumnos</th>
                                    <th><i class="fas fa-female"></i> F</th>
                                    <th><i class="fas fa-male"></i> M</th>
                                    <th><i class="fas fa-question"></i> N</th>
                                    <th>Media de aciertos</th>
                                    <th>Alumnos con calificaci&oacute;n</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php echo $llena_tabla_general; ?>
                            </tbody>
                        </table>

                        <br><br><br>
                        <div class="row">
                            <div class="chart-container">
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">
                        <i class="fas fa-award"></i>Aciertos obtenidos</div>
                    <div class="collapsible-body">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th>Rango de aciertos</th>
                                    <th>Alumnos en el rango</th>
                                    <th>Porcentaje</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php echo $llenar_tabla_aciertos_obtenidos; ?>
                            </tbody>
                        </table>

                        <br><br><br>
                        <div class="row">
                            <div class="chart-container">
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">
                        <i class="fas fa-graduation-cap"></i>Escuela de procedencia</div>
                    <div class="collapsible-body">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th>Nombre de la Escuela</th>
                                    <th>No. de Alumnos</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php echo $llenar_tabla_escuelas; ?>
                            </tbody>
                        </table>

                        <br><br><br>
                        <div class="row">
                            <div class="chart-container">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">
                        <i class="fas fa-list-ol"></i>Opci&oacute;n</div>
                    <div class="collapsible-body">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th>No. de opci&oacute;n</th>
                                    <th>No. de Alumnos</th>
                                </tr>
                            </thead>
                                <?php echo $llenar_tabla_opcion; ?>
                            <tbody>
                                
                            </tbody>
                        </table>

                        <br><br><br>
                        <div class="row">
                            <div class="chart-container">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </main>
</body>

<!--Import jQuery before materialize.js-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: <?php echo json_encode($tabla_opciones);?>,
                datasets: [{
                    label: 'No. de Alumnos',
                    data: <?php echo json_encode($data_opciones);?>,
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.5)',
                        'rgba(102, 102, 122, 0.5)',
                        'rgba(195, 255, 0, 0.5)',
                        'rgba(115, 11, 98, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 0, 0, 1)',
                        'rgba(102, 102, 122, 1)',
                        'rgba(195, 255, 0, 1)',,
                        'rgba(115, 11, 98, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
            }
        });


        var ctx2 = document.getElementById('myChart2');
        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ["F","M","N"],
                datasets: [{
                    label: 'No. de Alumnos',
                    data: [<?php echo $contador_F;?>,<?php echo $contador_M;?>,<?php echo $contador_N;?>],
                    backgroundColor: [
                        'rgba(255, 87, 249, 0.8)',
                        'rgba(47, 41, 240, 0.8)',
                        'rgba(75, 75, 77, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 87, 249, 1)',
                        'rgba(47, 41, 240, 1)',
                        'rgba(75, 75, 77, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false
            }
        });

        var ctx3 = document.getElementById('myChart3');
        Chart.defaults.global.elements.point.backgroundColor = "rgba(43, 0, 255, 1)";
        var myChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($data_rango);?>,
                datasets: [{
                    label: 'No. de Alumnos',
                    data: <?php echo json_encode($data_numAlumnos);?>,
                    backgroundColor:['rgba(0, 0, 0, 0)'],
                    borderColor: ['rgba(43, 0, 255, 1)'],
                    pointBackgroundColor: ['rgba(43, 0, 255, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
            },
        });

        var ctx4 = document.getElementById('myChart4');
        var myChart4 = new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: ["Alumnos de un CECyT","Alumnos de otras escuelas"],
                datasets: [{
                    label: 'No. de Alumnos',
                    data: [<?php echo $alumnos_cecyt;?>,<?php echo $alumnos_otraEsc;?>],
                    backgroundColor: [
                        'rgba(122, 0, 41, 0.2)',
                        'rgba(52, 235, 161, 0.2)',
                    ],
                    borderColor: [
                        'rgba(122, 0, 41, 1)',
                        'rgba(52, 235, 161, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false
            }
        });
    });
</script>

</html>