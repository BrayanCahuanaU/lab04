<?php

include 'conexiondb.php';

// Obtener datos del formulario de reserva
$fechaIngreso = $_POST['fecha_ingreso'];
$noches = $_POST['noches'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];

// Insertar datos de reserva en la tabla de reservas
$sql = "INSERT INTO reservas (fechaIngreso, noches, habitacion, huespedes) VALUES ('$fechaIngreso', $noches, '$habitacion', $huespedes)";

if ($conn->query($sql) === TRUE) {
    $reserva_id = $conn->insert_id; // Obtener el ID de la reserva recién insertada
    // Redireccionar al formulario de datos del cliente
    header("Location: formulario_cliente.php?reserva_id=$reserva_id");
} else {
    echo "Error al realizar la reserva: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
