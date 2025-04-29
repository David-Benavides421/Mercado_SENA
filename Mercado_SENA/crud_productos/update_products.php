<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

if (isset($_POST['actualizar'])) {
    $id_producto = intval($_POST['id_producto']);
    $nombre_producto = ($_POST['nombre_producto']);
    $valor_producto = ($_POST['valor_producto']);
    $cantidad_producto = intval($_POST['cantidad_producto']);

    $sql = "UPDATE productos SET NOMBRE_PRODUCTO = ?, VALOR_PRODUCTO = ?, CANTIDAD_PRODUCTO = ? WHERE ID_PRODUCTO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nombre_producto, $valor_producto, $cantidad_producto, $id_producto);

    if ($stmt->execute()) {
        // Redirigir automáticamente a productos.php después de insertar
        header("Location: /Mercado_SENA/crud_productos/products.php");
        exit(); // Asegurar que el script se detiene aquí
    } else {
        echo "Error al actualizar producto: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
