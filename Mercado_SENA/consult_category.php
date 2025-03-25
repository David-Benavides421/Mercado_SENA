<?php

require 'db.php';

$sql = "SELECT NOMBRE_CATEGORIA FROM categoria";
$result = $conn->query($sql);

if ($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        echo "La categoria es : " . $row["NOMBRE_CATEGORIA"]. "<br>";
    }
}else{
    echo"0 results";
}

$conn->close();

?>

<a href="category.php">Atras</a>