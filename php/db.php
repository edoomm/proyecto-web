<?php

function open_database() {
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "sistema_registro";

    $conn = mysqli_connect($host, $user, $pwd, $db);
    mysqli_set_charset($conn, "utf8");

    if (mysqli_connect_errno())
      echo "Failed to connect to MySQL: " . mysqli_connect_error();

    return $conn;
}

?>