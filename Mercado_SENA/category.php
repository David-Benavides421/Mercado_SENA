<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Document</title>
</head>
<body>
    <form id="form" method="post" name="form">
    <fieldset>
        <legend>Categoria</legend>
        <label>Digite la categoria: <input type="text" name="NOMBRE_CATEGORIA" size="40" maxlength="40" autofocus></label>
    </fieldset>
    <br>
    <input type="button" value="Insertar" id="nuevo" onclick="document.form.action='insert_category.php';document.form.submit()"/>
    <input type="button" value="Borrar" id="borrar" onclick="document.form.action='delete_category.php';document.form.submit()"/>
    <input type="button" value="Consultar" id="consultar" onclick="document.form.action='consult_category.php';document.form.submit()"/>
    <input type="button" value="Actualizar" id="actualizar" onclick="document.form.action='update_category.php';document.form.submit()"/><br><br>
    
    <a href="products.php">Ir a Productos</a><br><br>
    <a href="clientes.php">Ir a Clientes</a><br><br>
    <a href="login.php">Cerrar sesion</a>
</body>
</html>