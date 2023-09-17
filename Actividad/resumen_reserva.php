    <!DOCTYPE html>
    <html>
    <head>
        <title>Confirmación de Reserva</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5 text-center">
            <h2 class="text-center">Informacion Registrada</h2>
            <div class="row justify-content-center">
                <div class='d-inline-flex justify-content-center text-left'>
                    <?php
                    include 'conexiondb.php';

                    $cliente_id = $_GET['cliente_id'];
                    $reserva_id = $_GET['reserva_id'];

                    // Consulta para obtener los datos del cliente
                    $sql_cliente = "SELECT * FROM usuarios WHERE id = $reserva_id";
                    $result_cliente = $conn->query($sql_cliente);

                    if ($result_cliente->num_rows > 0) {
                        $cliente = $result_cliente->fetch_assoc();
                        echo "<div class='col-sm-6'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h3 class='card-title'>Datos del Cliente</h3>";
                        echo "<p class='card-text'><strong>Nombres:</strong></br>" . $cliente['nombres'] . "</p>";
                        echo "<p class='card-text'><strong>Apellidos:</strong></br>" . $cliente['apellidos'] . "</p>";
                        echo "<p class='card-text'><strong>DNI:</strong></br>" . $cliente['dni'] . "</p>";
                        echo "<p class='card-text'><strong>Celular:</strong></br>" . $cliente['celular'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    // Consulta para obtener los datos de la reserva
                    $sql_reserva = "SELECT * FROM reservas WHERE id = $reserva_id";
                    $result_reserva = $conn->query($sql_reserva);

                    if ($result_reserva->num_rows > 0) {
                        $reserva = $result_reserva->fetch_assoc();
                        echo "<div class='col-sm-6'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h3 class='card-title'>Datos de la Reserva</h3>";
                        echo "<p class='card-text'><strong>Fecha de Ingreso:</strong></br>" . $reserva['fechaIngreso'] . "</p>";
                        echo "<p class='card-text'><strong>Noches:</strong></br>" . $reserva['noches'] . "</p>";
                        echo "<p class='card-text'><strong>Tipo de Habitación:</strong></br>" . $reserva['habitacion'] . "</p>";
                        echo "<p class='card-text'><strong>Número de Huéspedes:</strong></br>" . $reserva['huespedes'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    
                    $conn->close();
                    ?>
                </div>
            </div>
            <form action="formulario_reserva.php" method="post" class="mt-5">
                <button type='submit' class='btn btn-success'>Terminar registro</button>
            </form>
        </div>
    </body>
    </html>
