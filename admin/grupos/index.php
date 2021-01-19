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
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

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

        <div class="row">
            
        </div>
    </main>

</body>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

</html>