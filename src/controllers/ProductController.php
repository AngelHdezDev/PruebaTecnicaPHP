<?php
class ProductController
{

    public static function createProduct($nombre, $descripcion, $precio, $cantidad)
    {
        require __DIR__ . '/../../config/db.php';


        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad) VALUES (:nombre, :descripcion, :precio, :cantidad)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'cantidad' => $cantidad
        ]);


   
        header("Refresh:0");

        exit;
    }

    
    public static function getAllProducts()
    {
        require __DIR__ . '/../../config/db.php';


        $sql = "SELECT * FROM productos";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductById($id)
    {
        require __DIR__ . '/../../config/db.php';


        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function editProduct($id, $nombre, $descripcion, $precio, $cantidad)
    {
        require __DIR__ . '/../../config/db.php';


        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, cantidad = :cantidad WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'cantidad' => $cantidad
        ]);

        header("Refresh:0");

        exit;

    }


    public static function deleteProduct($id)
    {
        require __DIR__ . '/../../config/db.php';
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<div class='alert alert-danger'>Producto eliminado con éxito.</div>";
    }
}
?>