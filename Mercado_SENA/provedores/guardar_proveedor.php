<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

$nombre_proveedor = $_POST['nombre_proveedor'];
$contacto_interno = $_POST['contacto_interno'];
$telefono_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$observaciones = $_POST['observaciones'];

$sql = "INSERT INTO proveedores (nombre_proveedor, contacto_interno, telefono_contacto, email_contacto, direccion, ciudad, pais, observaciones)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nombre_proveedor, $contacto_interno, $telefono_contacto, $email_contacto, $direccion, $ciudad, $pais, $observaciones);

if ($stmt->execute()) {
    echo "Proveedor registrado con éxito.";
} else {
    echo "Error al registrar el proveedor: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
