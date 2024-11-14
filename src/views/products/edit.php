<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../../controllers/ProductController.php';

if (isset($_GET['id'])) {
    $producto = ProductController::getProductById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    ProductController::editProduct($_GET['id'], $nombre, $descripcion, $precio, $cantidad);
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container mt-5">
        <h2>Editar Producto</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion"
                    value="<?php echo htmlspecialchars($producto['descripcion']); ?>" >
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio"
                    value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad"
                    value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required>
            </div>

            <div class="d-flex justify-content-between mt-4">

                <button type="submit" class="btn btn-primary">Actualizar Producto</button>

                <a href="list.php" class="btn btn-success">Regresar al listado</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>