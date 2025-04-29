<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

$id_cliente = $_POST['id_cliente'];
$fecha_emision = $_POST['fecha_emision'];
$productos = $_POST['productos'];
$cantidades = $_POST['cantidad'];

// Calcular el total de la factura
$total_factura = 0;

for ($i = 0; $i < count($productos); $i++) {
    $id_producto = $productos[$i];
    $cantidad = $cantidades[$i];

    // Obtener el precio del producto
    $sqlPrecio = "SELECT VALOR_PRODUCTO FROM productos WHERE ID_PRODUCTO = ?";
    $stmtPrecio = $conn->prepare($sqlPrecio);
    if (!$stmtPrecio) {
        die("Error en la preparación del precio: " . $conn->error);
    }

    $stmtPrecio->bind_param("i", $id_producto);
    $stmtPrecio->execute();
    $stmtPrecio->bind_result($precio_unitario);
    $stmtPrecio->fetch();
    $stmtPrecio->close();

    // Calcular el subtotal
    $subtotal = $precio_unitario * $cantidad;
    $total_factura += $subtotal;
}

// Insertar la factura en la tabla 'facturas'
$sqlFactura = "INSERT INTO facturas (id_cliente, fecha_factura, total_factura) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sqlFactura);

if (!$stmt) {
    die("Error en la preparación de la factura: " . $conn->error);
}

$stmt->bind_param("isd", $id_cliente, $fecha_emision, $total_factura);

if (!$stmt->execute()) {
    die("Error al insertar la factura: " . $stmt->error);
}

$id_factura = $stmt->insert_id;
$stmt->close();

// Insertar los detalles de la factura en 'detalle_factura'
$sqlDetalle = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad, subtotal) VALUES (?, ?, ?, ?)";
$stmtDetalle = $conn->prepare($sqlDetalle);

if (!$stmtDetalle) {
    die("Error en la preparación del detalle: " . $conn->error);
}

for ($i = 0; $i < count($productos); $i++) {
    $id_producto = $productos[$i];
    $cantidad = $cantidades[$i];
    $subtotal = $cantidad * $precio_unitario;

    $stmtDetalle->bind_param("iiid", $id_factura, $id_producto, $cantidad, $subtotal);

    if (!$stmtDetalle->execute()) {
        die("Error al insertar detalle: " . $stmtDetalle->error);
    }
}

$stmtDetalle->close();
$conn->close();

// Mostrar el total de la factura
echo "Factura registrada con éxito. Número de factura: " . $id_factura . "<br>";
echo "Total Última Factura: $" . number_format($total_factura, 2);
?>
