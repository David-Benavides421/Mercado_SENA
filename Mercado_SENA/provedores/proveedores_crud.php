<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS proveedores (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre_proveedor VARCHAR(255) NOT NULL,
    contacto_interno VARCHAR(255),
    telefono_contacto VARCHAR(20),
    email_contacto VARCHAR(255),
    direccion VARCHAR(255),
    ciudad VARCHAR(100),
    pais VARCHAR(100),
    observaciones TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$sql1 = "CREATE TABLE IF NOT EXISTS ordenes_compra (
    id_orden INT AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT NOT NULL,
    fecha DATE NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('Pendiente', 'Procesada', 'Cancelada') DEFAULT 'Pendiente',
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

$conn->query($sql);
$conn->query($sql1);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de proveedores</title>
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
</head>
<body>
    <h2>Gestion de proveedores</h2>
    <form action="/Mercado_SENA/provedores/guardar_proveedor.php" method="post">

    <label>Nombre del Poveedor: </label>
    <input type="text" name="nombre_proveedor" required>

    <label>Contacto Interno: </label>
    <input type="text" name="contacto_interno">

    <label>Teléfono de Contacto: </label>
    <input type="text" name="telefono_contacto">

    <label>Email: </label>
    <input type="text" name="email_contacto">

    <label>Dirección: </label>
    <input type="text" name="direccion">

    <label>Ciudad: </label>
    <input type="text" name="ciudad">

    <label>Pais: </label>
    <input type="text" name="pais">

    <label>observaciones:</label>
    <textarea name="observaciones"></textarea>
    <input type="submit" value="Guardar Proveedor">
</form>

<h2>Lista de Proveedores</h2>
<table>
<tr>
    <th>Nombre</th>
    <th>Contacto</th>
    <th>Teléfono</th>
    <th>Email</th>
    <th>Dirección</th>
    <th>Ciudad</th>
    <th>País</th>
    <th>Acciones</th>
</tr>

<?php
$sql = "SELECT * FROM proveedores";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["nombre_proveedor"] . "</td>";
    echo "<td>" . $row["contacto_interno"] . "</td>";
    echo "<td>" . $row["telefono_contacto"] . "</td>";
    echo "<td>" . $row["email_contacto"] . "</td>";
    echo "<td>" . $row["direccion"] . "</td>";
    echo "<td>" . $row["ciudad"] . "</td>";
    echo "<td>" . $row["pais"] . "</td>";
    echo "<td class='acciones-coloumn'>
        <a href='/Mercado_SENA/provedores/editar_proveedor.php?id=" . $row["id_proveedor"] . "' class='btn-eliminar'>Editar</a>
        <div class='separador-botones'>|</div>
    
        <form action='/Mercado_SENA/provedores/eliminar_proveedor.php' method='post' style='display:inline;'onsubmit='return confirm(\"¿Estás seguro de eliminar este proveedor?\");'>
        <input type='hidden' name='id_proveedor' value='" . $row["id_proveedor"] . "'>
        <button type='submit' class='btn-eliminar' >Eliminar</button>
        </form>
    </td>";
    echo "</tr>";
    }
    ?>
</table>
<br><br><a href="/Mercado_SENA/crud_categoria/category.php"><button>ir a Catergoria</button></a>
</body>
</html>
