<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    $sql = "DELETE FROM productos WHERE ID_PRODUCTO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        // Redirigir automáticamente a productos.php después de eliminar
        header("Location: products.php");
        exit(); // Asegurar que el script se detiene aquí
    } else {
        echo "Error al eliminar producto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
