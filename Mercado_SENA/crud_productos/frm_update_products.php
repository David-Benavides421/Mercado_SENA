<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE ID_PRODUCTO = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("i", $id);
$stmt -> execute();
$result = $stmt -> get_result();
$row = $result -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos</title>
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
</head>
<body>
    <h2>Editar productos</h2>
    <form action="/Mercado_SENA/crud_productos/update_products.php" method="POST">
        <input type="hidden" name="id_producto" value="<?= $row['ID_PRODUCTO'] ?>">
        <input type="text" name="nombre_producto" value="<?= $row['NOMBRE_PRODUCTO'] ?>">
        <label>Precio: </label>
        <input type="number" name="valor_producto" value="<?= $row['VALOR_PRODUCTO'] ?>">
        <label>Cantidad disponible: </label>
        <input type="number" name="cantidad_producto" value="<?= $row['CANTIDAD_PRODUCTO'] ?>"><br>

        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>