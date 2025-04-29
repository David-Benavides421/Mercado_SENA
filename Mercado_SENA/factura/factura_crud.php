<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

// Obtener clientes 
$sqlClientes = "SELECT ID_CLIENTE, NOMBRE_CLIENTE FROM clientes";
$resultClientes = $conn->query($sqlClientes);

// Obtener productos
$sqlProductos = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, VALOR_PRODUCTO FROM productos";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
</head>
<body>
    <h2>Facturación</h2>

    <div class="total-factura">Total Factura Actual: <span id="totalFacturaActual">$0.00</span></div>

    <form action="/Mercado_SENA/factura/procesar_factura.php" method="post">
        <label>Fecha de Emisión:</label>
        <input type="date" name="fecha_emision" value="<?php echo date('Y-m-d'); ?>">

        <label>Cliente:</label>
        <select name="id_cliente" required>
            <option value="">Seleccionar Cliente</option>
            <?php while ($row = $resultClientes->fetch_assoc()) { ?>
                <option value="<?php echo $row['ID_CLIENTE']; ?>"> <?php echo $row['NOMBRE_CLIENTE']; ?> </option>
            <?php } ?>
        </select>

        <h3>Productos</h3>

        <table id="productosTable">
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </table>

        <button type="button" onclick="agregarProducto()">Agregar Producto</button>
        <input type="submit" value="Terminar Factura">
    </form>

    <a href="/Mercado_SENA/clientes.php"><button>Ir a clientes</button></a><br>
    <br><a href="/Mercado_SENA/crud_categoria/category.php"><button>ir a Catergoria</button></a>
</body>
</html>

<script>
    let productos = [];
    <?php while ($row = $resultProductos->fetch_assoc()) { ?>
        productos.push({ id: <?php echo $row['ID_PRODUCTO']; ?>, nombre: "<?php echo $row['NOMBRE_PRODUCTO']; ?>", precio: <?php echo $row['VALOR_PRODUCTO']; ?> });
    <?php } ?>

    function agregarProducto() {
        const table = document.getElementById('productosTable');
        const row = table.insertRow();

        // Agregar Descripción con lista desplegable
        let select = document.createElement('select');
        select.name = 'productos[]';
        productos.forEach(prod => {
            let option = document.createElement('option');
            option.value = prod.id;
            option.text = `${prod.nombre} - $${prod.precio}`;
            select.appendChild(option);
        });
        row.insertCell(0).appendChild(select);

        // Agregar Cantidad
        let cantidad = document.createElement('input');
        cantidad.type = 'number';
        cantidad.name = 'cantidad[]';
        cantidad.min = 1;
        cantidad.value = 1;
        cantidad.onchange = actualizarTotal;
        row.insertCell(1).appendChild(cantidad);

        // Agregar Precio Unitario
        let precioUnitario = document.createElement('span');
        precioUnitario.innerText = "$0.00";
        row.insertCell(2).appendChild(precioUnitario);

        // Agregar Total
        let total = document.createElement('span');
        total.innerText = "$0.00";
        row.insertCell(3).appendChild(total);

        // Agregar Botón de Borrar
        let botonEliminar = document.createElement('button');
        botonEliminar.innerText = 'Borrar';
        botonEliminar.onclick = function () { 
            table.deleteRow(row.rowIndex); 
            actualizarTotal(); 
        };
        row.insertCell(4).appendChild(botonEliminar);
        
        actualizarTotal();
    }

    function actualizarTotal() {
        const rows = document.querySelectorAll('#productosTable tr');
        let totalFactura = 0;
        
        rows.forEach((row, index) => {
            if (index === 0) return; // Saltar encabezado
            const select = row.cells[0].querySelector('select');
            const cantidad = parseInt(row.cells[1].querySelector('input').value);
            const producto = productos.find(p => p.id == select.value);

            row.cells[2].querySelector('span').innerText = `$${producto.precio.toFixed(2)}`;
            const totalProducto = producto.precio * cantidad;
            row.cells[3].querySelector('span').innerText = `$${totalProducto.toFixed(2)}`;
            totalFactura += totalProducto;
        });

        document.getElementById('totalFacturaActual').innerText = `$${totalFactura.toFixed(2)}`;
    }
</script>

<?php $conn->close(); ?>
