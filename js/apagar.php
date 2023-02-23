<?php
require_once("conexao.php");

$ID = $_POST['ID'];

$sqlquery = "DELETE FROM clientes WHERE ID = $ID ";

if (mysqli_query($conn, $sqlquery)) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Error: " . $sqlquery . "<br>" . mysqli_error($conn);
}

$conn->close();
?>