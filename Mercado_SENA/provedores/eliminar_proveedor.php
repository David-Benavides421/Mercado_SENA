<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

// Verificar si se recibió el ID del proveedor y si es un número válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_proveedor']) && is_numeric($_POST['id_proveedor'])) {
    $id_proveedor = intval($_POST['id_proveedor']); // Convertir a entero para seguridad
    
    // Verificar si el proveedor tiene ordenes de compra asociadas
    $sql_check = "SELECT COUNT(*) as total FROM ordenes_compra WHERE id_proveedor = ?";
    $stmt_check = $conn->prepare($sql_check);
    
    if ($stmt_check) {
        $stmt_check->bind_param("i", $id_proveedor);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $stmt_check->close();
        if ($row_check['total'] > 0) {
            die("<script>alert('No se puede eliminar el proveedor porque tiene órdenes de compra asociadas.'); window.location.href='proveedores_crud.php'</script>");
        }
    } else {
        die("Error en la consulta de verificación: " . $conn->error);
    }
    
    // Eliminar el proveedor
    $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_proveedor);
        if ($stmt->execute()) {
            echo "<script>alert('Proveedor eliminado correctamente.'); window.location.href='/Mercado_SENA/provedores/proveedores_crud.php';</script>";
        } else {
            echo "Error al eliminar el proveedor: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la consulta de eliminación: " . $conn->error;
    }
} else {
    echo "<script>alert('Error: No se proporcionó un ID de proveedor válido.'); window.location.href='/Mercado_SENA/provedores/proveedores_crud.php'</script>";
}

$conn->close();
?>