<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Categoría</title>
    <style>
        form { width: 50%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input, button, select { width: 100%; margin: 10px 0; padding: 10px; }
    </style>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h2>Actualizar Categoría</h2>
    <form action="update_category.php" method="POST">
        <label for="ID_CATEGORIA">Seleccione la categoría:</label>
        <select name="ID_CATEGORIA" required>
            <option value="">Seleccione una categoría</option>
            <?php
                include 'db.php';
                $sql = "SELECT ID_CATEGORIA, NOMBRE_CATEGORIA FROM categoria";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['ID_CATEGORIA']."'>".$row['NOMBRE_CATEGORIA']."</option>";
                }
            ?>
        </select>
        <input type="text" name="nuevo_nombre" placeholder="Nuevo Nombre de la Categoría" required>
        <button type="submit" name="actualizar">Actualizar Categoría</button>
    </form>
</body>
</html>
