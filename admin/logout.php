<?php

session_start();

$temp = $_REQUEST["nombreSesion"];
unset($_SESSION[$temp]);

header("location:../");

?>