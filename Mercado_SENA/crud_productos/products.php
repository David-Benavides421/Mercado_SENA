<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

// Obtener todos los productos
$sql = "SELECT p.ID_PRODUCTO, p.NOMBRE_PRODUCTO, p.VALOR_PRODUCTO, p.CANTIDAD_PRODUCTO, c.NOMBRE_CATEGORIA
        FROM productos p
        JOIN categoria c ON p.ID_CATEGORIA = c.ID_CATEGORIA";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
    <title>Gestión de Productos</title>
</head>
<body>
    <h2>Gestión de Productos</h2>

    <h3>Agregar productos</h3>
    <form action="/Mercado_SENA/crud_productos/insert_products.php" method="POST">
        <input type="text" name="nombre_producto" placeholder="Nombre del producto" required>
        <input type="number" name="valor_producto" placeholder="Valor producto" required>
        <input type="number" name="cantidad_producto" placeholder="Cantidad" required>
        <select name="id_categoria" required>
            <option value="">Seleccione una categoría</option>
            
            <?php
            $sqlCat = "SELECT ID_CATEGORIA, NOMBRE_CATEGORIA FROM categoria";
            $resultCat = $conn->query($sqlCat);
            while ($rowCat = $resultCat->fetch_assoc()) {
                echo "<option value='".$rowCat['ID_CATEGORIA']."'>".$rowCat['NOMBRE_CATEGORIA']."</option>";
            }
            ?>
        </select>
        <button type="submit" name="insertar">Agregar</button>
    </form>

    <h3>Lista de Productos</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Valor</th>
            <th>Cantidad</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['ID_PRODUCTO'] ?></td>
            <td><?= $row['NOMBRE_PRODUCTO'] ?></td>
            <td><?= $row['VALOR_PRODUCTO'] ?></td>
            <td><?= $row['CANTIDAD_PRODUCTO'] ?></td>
            <td><?= $row['NOMBRE_CATEGORIA'] ?></td>
            <td>
                <a href="/Mercado_SENA/crud_productos/frm_update_products.php?id=<?= $row['ID_PRODUCTO'] ?>">Editar</a>  
                <a href="/Mercado_SENA/crud_productos/delete_products.php?id=<?= $row['ID_PRODUCTO'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>     
    </table>
    <br><br><a href="/Mercado_SENA/crud_categoria/category.php"><button>ir a Catergoria</button></a>
</body>
</html>
