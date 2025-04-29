<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

// Obtener el ID del proveedor a editar
if (!isset($_GET['id'])) {
    die("ID de proveedor no proporcionado.");
}

$id_proveedor = $_GET['id'];

// Consultar los datos del proveedor
$sql = "SELECT * FROM proveedores WHERE id_proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_proveedor);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Proveedor no encontrado.");
}

$proveedor = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
</head>
<body>
    <h2>Editar Proveedor</h2>
    <form action="/Mercado_SENA/provedores/actualizar_proveedor.php" method="post">
        <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']; ?>">
        
        <label>Nombre del Proveedor:</label>
        <input type="text" name="nombre_proveedor" value="<?php echo $proveedor['nombre_proveedor']; ?>" required>
        
        <label>Contacto Interno:</label>
        <input type="text" name="contacto_interno" value="<?php echo $proveedor['contacto_interno']; ?>">
        
        <label>Teléfono de Contacto:</label>
        <input type="text" name="telefono_contacto" value="<?php echo $proveedor['telefono_contacto']; ?>">
        
        <label>Email de Contacto:</label>
        <input type="email" name="email_contacto" value="<?php echo $proveedor['email_contacto']; ?>">
        
        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $proveedor['direccion']; ?>">
        
        <label>Ciudad:</label>
        <input type="text" name="ciudad" value="<?php echo $proveedor['ciudad']; ?>">
        
        <label>País:</label>
        <input type="text" name="pais" value="<?php echo $proveedor['pais']; ?>">
        
        <label>Observaciones:</label>
        <textarea name="observaciones"><?php echo $proveedor['observaciones']; ?></textarea>

        <input type="submit" value="Actualizar Proveedor">
        <a href="/Mercado_SENA/provedores/proveedores_crud.php">Cancelar</a>
        
    </form>
</body>
</html>

<?php
$conn->close();
?>