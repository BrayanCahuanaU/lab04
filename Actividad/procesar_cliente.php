<?php

include 'conexiondb.php';

// Obtener datos del formulario de cliente
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$celular = $_POST['celular'];

$reserva_id = $_POST['reserva_id'];
$sql = "INSERT INTO usuarios (id, nombres, apellidos, dni, celular) VALUES ('$reserva_id','$nombres', '$apellidos', '$dni', '$celular')";

if ($conn->query($sql) === TRUE) {
    $usuario_id = $conn->insert_id;

    $sql_update = "UPDATE reservas SET usuario_id = $usuario_id WHERE id = $reserva_id";
    header("Location: resumen_reserva.php?cliente_id=$cliente_id&reserva_id=$reserva_id");
} else {
    echo "Error al registrar al cliente: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
