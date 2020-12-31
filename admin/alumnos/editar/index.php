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
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

    <header>
        <!-- Top navbar -->
        <nav>
            <div class="nav-wrapper blue">
                <ul id="nav-mobile" class="left" style="position: absolute; left: -1%; top: 50%; -webkit-transform: translate(0%, -50%); transform: translate(0%, -50%);">
                    <a href="../alumnos/"><li><i class="material-icons">chevron_left</i></li></a>
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
        <div class="row">
            <div class="col s12 l4 offset-l4">
                <div class="card-panel hoverable">
                    <div class="card-action lighten-1 blue-text">
                        <h4 style="text-align: center;">Editar información</h4>
                    </div>

                    <div class="card-content">
                        <div class="form-field">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre">
                        </div><br>
                        <div class="form-field">
                            <label for="apellidopat">Apellido paterno</label>
                            <input type="text" name="apellidopat" id="apellidopat">
                        </div><br>
                        <div class="form-field">
                            <label for="apellidomat">Apellido materno</label>
                            <input type="text" name="apellidomat" id="apellidomat">
                        </div><br>
        
                        <div class="form-field">
                            <button class="btn-large waves-effect waves-dark blue" style="width: 100%;">Guardar</button>
                        </div><br>
                        <div class="form-field">
                            <button class="btn-large waves-effect waves-dark white red-text" style="width: 100%;">Eliminar</button>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>