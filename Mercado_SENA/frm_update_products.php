<?php
require 'db.php';
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
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h2>Editar productos</h2>
    <form action="update_products.php" method="POST">
        <input type="hidden" name="id_producto" value="<?= $row['ID_PRODUCTO'] ?>">
        <input type="text" name="nombre_producto" value="<?= $row['NOMBRE_PRODUCTO'] ?>">
        <input type="number" name="valor_producto" value="<?= $row['VALOR_PRODUCTO'] ?>">
        <input type="number" name="cantidad_producto" value="<?= $row['CANTIDAD_PRODUCTO'] ?>">

        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>