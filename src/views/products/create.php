<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require '../../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    ProductController::createProduct($nombre, $descripcion, $precio, $cantidad);
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Producto</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h2>Registro de Producto</h2>
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="d-flex justify-content-between mt-4">

                <button type="submit" class="btn btn-primary" name="submit">Registrar Producto</button>

                <a href="list.php" class="btn btn-success">Regresar al listado</a>
            </div>
        </form>

    </div>
</body>

</html>