<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_cliente";
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed:"
        . $conn->connect_error);
}
 
$sqlquery = "INSERT INTO clientes (nome, CPF, RG, CEP, Endereco, Cidade, Estado, Numero, Email, foto) VALUES
    ('$_POST[nome]', '$_POST[CPF]', '$_POST[RG]', '$_POST[CEP]', '$_POST[Endereco]', '$_POST[Cidade]', '$_POST[Estado]', '$_POST[Numero]', '$_POST[Email]', '$_POST[Email]')";
if ($conn->query($sqlquery) === TRUE) {
    echo "record inserted successfully";
} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

 
// Closing the connection.
// $conn->close();
 
// ?> -->
