<?php

require '/xampp/htdocs/Mercado_SENA/config/db.php';

$borrar=$_POST['NOMBRE_CATEGORIA'];

$sql = "DELETE FROM categoria WHERE NOMBRE_CATEGORIA = '$borrar'";

if ($conn->query($sql)===TRUE) {
    echo "Record deleted successfully";
} else {
    echo" Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
<a href="/Mercado_SENA/crud_categoria/category.php"></a>