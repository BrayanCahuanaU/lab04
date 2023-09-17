<!DOCTYPE html>
<html>
<head>
    <title>Reserva de Hotel - Datos del Cliente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script></head>
<body>
    <div class="mb-3">
        <div class="container">
            <h2 class="mt-5 text-center">Datos Perosonales</h2>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Aloft_Hotels_logo.svg/431px-Aloft_Hotels_logo.svg.png" alt="imgagen-logo" class="mx-auto d-block">
            <form action="procesar_cliente.php" method="post">
                <input type="hidden" name="reserva_id" value="<?php echo $_GET['reserva_id']; ?>">
                <div class="form-group ">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" class="form-control" name="dni" required>
                </div>

                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" class="form-control" name="celular" required>
                </div>
                <button type="submit" class="btn btn-primary">Siguiente</button>
            </form>
        </div>
    </div>
</body>
</html>
