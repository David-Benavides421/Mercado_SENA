<?php
require '/xampp/htdocs/Mercado_SENA/config/db.php';

// Recibir datos
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];

// Manejo de foto
$foto = null;
if (!empty($_FILES['foto']['name'])) {
    $foto = "/assets/uploads/" . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
}

// Insertar en la base de datos
$sql = "INSERT INTO almacenes (nombre_almacen, direccion, latitud, longitud, foto) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdds", $nombre, $direccion, $latitud, $longitud, $foto);

if ($stmt->execute()) {
    echo "Almacén registrado con éxito.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
