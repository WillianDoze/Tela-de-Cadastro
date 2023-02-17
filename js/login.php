<?php
 require_once("conexao.php");

$nome_foto = $_FILES['foto']['name'];
date_default_timezone_set('America/Sao_Paulo');
$hora = date('d/m/Y H:i:s');
$sqlquery = "INSERT INTO clientes VALUES
    ('$_POST[nome]', '$_POST[CPF]', '$_POST[RG]', '$_POST[CEP]', '$_POST[Endereco]', '$_POST[Cidade]', '$_POST[Estado]', '$_POST[Numero]', '$_POST[Email]', '$_POST[Senha]','$nome_foto', '$hora', '')";

if ($conn->query($sqlquery) === TRUE) {
    echo "record inserted successfully";
} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

// Closing the connection.
$conn->close();
 
?>

