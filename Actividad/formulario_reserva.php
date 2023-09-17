    <!DOCTYPE html>
    <html>
    <head>
        <title>Formulario de Reserva de Hotel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="mb-3">
            <div class="container">
                <h2 class="mt-5 text-center">Formulario de Reserva de Hotel</h2>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Aloft_Hotels_logo.svg/431px-Aloft_Hotels_logo.svg.png" alt="imgagen-logo" class="mx-auto d-block">
                <form action="procesar_reserva.php" method="post">
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" name="fecha_ingreso" required>
                    </div>

                    <div class="form-group">
                        <label for="noches">Número de Noches:</label>
                        <input type="number" class="form-control" name="noches" required>
                    </div>

                    <div class="form-group">
                        <label for="habitacion">Tipo de Habitación:</label>
                        <select class="form-control" name="habitacion" required>
                            <option value="individual">Individual</option>
                            <option value="doble">Doble</option>
                            <option value="suite">Suite</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="huespedes">Número de Huéspedes:</label>
                        <input type="number" class="form-control" name="huespedes" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Reservar</button>
                </form>
            </div>
        </div>
    </body>
    </html>
