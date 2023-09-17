<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab04(ejercico)";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para agregar un cliente
function agregarCliente($nombre, $email) {
    global $conn;
    $sql = "INSERT INTO clientes (nombre, email) VALUES ('$nombre', '$email')";
    $conn->query($sql);
}

// Función para agregar un pedido
function agregarPedido($cliente_id, $producto, $cantidad) {
    global $conn;
    $sql = "INSERT INTO pedidos (cliente_id, producto, cantidad) VALUES ('$cliente_id', '$producto', '$cantidad')";
    $conn->query($sql);
}

// Función para obtener la lista de clientes con sus pedidos
function obtenerClientesConPedidos() {
    global $conn;
    $sql = "SELECT clientes.id, clientes.nombre, clientes.email, GROUP_CONCAT(pedidos.producto) AS productos
            FROM clientes
            LEFT JOIN pedidos ON clientes.id = pedidos.cliente_id
            GROUP BY clientes.id";
    $result = $conn->query($sql);
    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
    return $clientes;
}

// Función para eliminar un cliente y sus pedidos
function eliminarCliente($cliente_id) {
    global $conn;
    // Eliminar pedidos del cliente
    $sql1 = "DELETE FROM pedidos WHERE cliente_id = $cliente_id";
    $conn->query($sql1);
    // Eliminar al cliente
    $sql2 = "DELETE FROM clientes WHERE id = $cliente_id";
    $conn->query($sql2);
}

// Función para actualizar un cliente
function actualizarCliente($cliente_id, $nombre, $email) {
    global $conn;
    $sql = "UPDATE clientes SET nombre = '$nombre', email = '$email' WHERE id = $cliente_id";
    $conn->query($sql);
}

// Función para actualizar un pedido
function actualizarPedido($pedido_id, $producto, $cantidad) {
    global $conn;
    $sql = "UPDATE pedidos SET producto = '$producto', cantidad = '$cantidad' WHERE id = $pedido_id";
    $conn->query($sql);
}

// Resto del código para manejar las operaciones CRUD (actualizar, eliminar, etc.) según tus necesidades

// Manejo de las operaciones de actualización y eliminación
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["agregarCliente"])) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        agregarCliente($nombre, $email);
    } elseif (isset($_POST["agregarPedido"])) {
        $cliente_id = $_POST["cliente_id"];
        $producto = $_POST["producto"];
        $cantidad = $_POST["cantidad"];
        agregarPedido($cliente_id, $producto, $cantidad);
    } elseif (isset($_POST["eliminarCliente"])) {
        $cliente_id = $_POST["cliente_id"];
        eliminarCliente($cliente_id);
    } elseif (isset($_POST["actualizarCliente"])) {
        $cliente_id = $_POST["cliente_id"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        actualizarCliente($cliente_id, $nombre, $email);
    } elseif (isset($_POST["actualizarPedido"])) {
        $pedido_id = $_POST["pedido_id"];
        $producto = $_POST["producto"];
        $cantidad = $_POST["cantidad"];
        actualizarPedido($pedido_id, $producto, $cantidad);
    }
}

$clientesConPedidos = obtenerClientesConPedidos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP y MySQL con Bootstrap</title>
    <!-- Incluye los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Clientes</h1>
        <form method="POST" class="mb-3">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del cliente:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email del cliente:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" name="agregarCliente" class="btn btn-primary">Agregar Cliente</button>
        </form>

        <h1>Pedidos</h1>
        <form method="POST" class="mb-3">
            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente:</label>
                <select id="cliente_id" name="cliente_id" class="form-select" required>
                    <?php foreach ($clientesConPedidos as $cliente) { ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="producto" class="form-label">Producto:</label>
                <input type="text" id="producto" name="producto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" required>
            </div>
            <button type="submit" name="agregarPedido" class="btn btn-primary">Agregar Pedido</button>
        </form>

        <h1>Listado de Clientes con Pedidos</h1>
        <ul class="list-group">
            <?php foreach ($clientesConPedidos as $cliente) { ?>
                <li class="list-group-item">
                    <strong>Cliente:</strong> <?php echo $cliente['nombre']; ?><br>
                    <strong>Email:</strong> <?php echo $cliente['email']; ?><br>
                    <strong>Pedidos:</strong> <?php echo $cliente['productos']; ?><br>
                    <!-- Botones para actualizar y eliminar -->
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                        <button type="submit" name="eliminarCliente" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarCliente<?php echo $cliente['id']; ?>">Editar</button>
                </li>

                <!-- Modal de edición para cada cliente -->
                <div class="modal fade" id="editarCliente<?php echo $cliente['id']; ?>" tabindex="-1" aria-labelledby="editarClienteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarClienteLabel">Editar Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="nombreEditar" class="form-label">Nombre del cliente:</label>
                                        <input type="text" id="nombreEditar" name="nombre" class="form-control" value="<?php echo $cliente['nombre']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="emailEditar" class="form-label">Email del cliente:</label>
                                        <input type="email" id="emailEditar" name="email" class="form-control" value="<?php echo $cliente['email']; ?>" required>
                                    </div>
                                    <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                                    <button type="submit" name="actualizarCliente" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </ul>

        <!-- Resto de las operaciones CRUD (actualizar, eliminar, etc.) -->

    </div>

    <!-- Incluye los archivos JavaScript de Bootstrap (jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
