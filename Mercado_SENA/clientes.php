<?php
// concexion.php
require '/xampp/htdocs/Mercado_SENA/config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS clientes (
    ID_CLIENTE INT AUTO_INCREMENT PRIMARY KEY,
    NOMBRE_CLIENTE VARCHAR(50) NOT NULL,
    EMAIL_CLIENTE VARCHAR(100) NOT NULL,
    TELEFONO_CLIENTE VARCHAR(20)
) ENGINE=InnoDB;";

$conn->query($sql);

// Procesar acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);

    if (!empty($nombre) && !empty($email)) {
        if (!empty($_POST['id_cliente'])) { // Cambié 'ID_CLIENTE' por 'id_cliente' para que coincida con el campo oculto del formulario
            // Actualizar
            $id_cliente = intval($_POST['id_cliente']);
            $stmt = $conn->prepare("UPDATE clientes SET NOMBRE_CLIENTE = ?, EMAIL_CLIENTE = ?, TELEFONO_CLIENTE = ? WHERE ID_CLIENTE = ?"); 
            $stmt->bind_param('sssi', $nombre, $email, $telefono, $id_cliente);
        } else {
            // Insertar (Error corregido en la consulta SQL)
            $stmt = $conn->prepare("INSERT INTO clientes (NOMBRE_CLIENTE, EMAIL_CLIENTE, TELEFONO_CLIENTE) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $nombre, $email, $telefono);
        }
        if ($stmt->execute()) {
            echo 'Operación realizada con éxito';
        } else {
            echo 'Error: ' . $stmt->error;
        }
    } else {
        echo 'Por favor complete todos los campos obligatorios.';
    }
    header('Location: /Mercado_SENA/clientes.php');
    exit;
}

if (isset($_GET['eliminar'])) {
    $id_cliente = intval($_GET['eliminar']);
    $conn->query("DELETE FROM clientes WHERE ID_CLIENTE = $id_cliente");
    header('Location: /Mercado_SENA/clientes.php');
    exit;
}

// Obtener datos para mostrar
$result = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Clientes</title>
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
</head>
<body>
    <h2>Formulario de Clientes</h2>
    <form action="/Mercado_SENA/clientes.php" method="POST">
        <input type="hidden" name="id_cliente" value="<?= isset($_GET['editar']) ? htmlspecialchars($_GET['editar']) : '' ?>">
        <label>Nombre: <input type="text" name="nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" required></label><br>
        <label>Teléfono: <input type="text" name="telefono" value="<?= isset($_GET['telefono']) ? htmlspecialchars($_GET['telefono']) : '' ?>"></label><br>
        <button type="submit">Guardar</button>
    </form>

    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['ID_CLIENTE'] ?></td>
            <td><?= htmlspecialchars($row['NOMBRE_CLIENTE']) ?></td>
            <td><?= htmlspecialchars($row['EMAIL_CLIENTE']) ?></td>
            <td><?= htmlspecialchars($row['TELEFONO_CLIENTE']) ?></td>
            <td>
                <a href="/Mercado_SENA/clientes.php?editar=<?= $row['ID_CLIENTE'] ?>&nombre=<?= urlencode($row['NOMBRE_CLIENTE']) ?>&email=<?= urlencode($row['EMAIL_CLIENTE']) ?>&telefono=<?= urlencode($row['TELEFONO_CLIENTE']) ?>">Editar</a> | 
                <a href="/Mercado_SENA/clientes.php?eliminar=<?= $row['ID_CLIENTE'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br><br><a href="/Mercado_SENA/products.php">Ir a Productos</a><br><br>
    <a href="/Mercado_SENA/crud_categoria/category.php">Volver a Categoria</a><br><br>
    <a href="/Mercado_SENA/login/login.php">Cerrar sesion</a>
</body>
</html>
