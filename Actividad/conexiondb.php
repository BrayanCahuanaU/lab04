<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab04";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>