<?php

require 'db.php';
$nuevo=$_POST['NOMBRE_CATEGORIA'];

$sql = "INSERT INTO categoria (ID_CATEGORIA, NOMBRE_CATEGORIA)
VALUES (NULL,'$nuevo')";

if ($conn->query($sql)===TRUE) {
    echo "New record created succesfully";
    header("Location: category.php");
} else {
    echo" Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
