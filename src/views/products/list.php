<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit();
}
require_once '../../controllers/ProductController.php';

$productos = ProductController::getAllProducts();
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Listado de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php include __DIR__ . '/../partials/navbar.php'; ?>
  <div class="container mt-5">
    <h2>Listado de Productos</h2>
    <a href="create.php" class="btn btn-primary mb-3">Agregar Producto</a>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos as $producto): ?>
          <tr>
            <td><?php echo htmlspecialchars($producto['id']); ?></td>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $producto['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="delete.php?id=<?php echo $producto['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>