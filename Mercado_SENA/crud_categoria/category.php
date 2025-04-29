<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Mercado_SENA/assets/styles.css">
    <title>Document</title>
</head>
<body>
    <form id="form" method="post" name="form">
    <fieldset>
        <legend>Categoria</legend>
        <label>Digite la categoria: <input type="text" name="NOMBRE_CATEGORIA" size="40" maxlength="40" autofocus></label>
    </fieldset>
    <br>
    

    <input type="button" value="Crear" id="nuevo" onclick="document.form.action='/Mercado_SENA/crud_categoria/insert_category.php';document.form.submit()"/>
    <input type="button" value="Consultar" id="consultar" onclick="document.form.action='/Mercado_SENA/crud_categoria/consult_category.php';document.form.submit()"/>
    <input type="button" value="Actualizar" id="actualizar" onclick="document.form.action='/Mercado_SENA/crud_categoria/update_category.php';document.form.submit()"/>
    <input type="button" value="Borrar" id="borrar" onclick="document.form.action='/Mercado_SENA/crud_categoria/delete_category.php';document.form.submit()"/><br><br>
    
    <a href="/Mercado_SENA/crud_productos/products.php"><button>ir a Productos</button></a><br><br>
    <a href="/Mercado_SENA/clientes.php"><button>ir a Clientes</button></a><br><br>
    <a href="/Mercado_SENA/almacen/almacen_crud.php"><button>ir a almacen</button></a><br><br>
    <a href="/Mercado_SENA/provedores/proveedores_crud.php"><button>ir a proveedores</button></a><br><br>
    <a href="/Mercado_SENA/factura/factura_crud.php"><button>ir a factura</button></a><br><br>
    <a href="/Mercado_SENA/login/login.php"><button>Cerrar sesion</button></a>
</body>
</html>