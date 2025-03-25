<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = ($_POST['nombre_producto']);
    $valor_producto = ($_POST['valor_producto']);
    $cantidad_producto = intval($_POST['cantidad_producto']);
    $id_categoria = intval($_POST['id_categoria']);

    $sql = "INSERT INTO productos (NOMBRE_PRODUCTO, VALOR_PRODUCTO, CANTIDAD_PRODUCTO, ID_CATEGORIA) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nombre_producto, $valor_producto, $cantidad_producto, $id_categoria);

    if ($stmt->execute()) {
        // Redirigir automáticamente a productos.php después de insertar
        header("Location: products.php");
        exit(); // Asegurar que el script se detiene aquí
    } else {
        echo "Error al agregar producto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
