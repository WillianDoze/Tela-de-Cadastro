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
    die("Connection failed: "
        . $conn->connect_error);
}
$nome_foto = $_FILES['foto']['name'];
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


 
<!-- // if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
//     // collect value of input field
//     $data = $_REQUEST['val1'];
 
//     if (empty($data)) {
//         echo "data is empty";
//     } else {
//         echo $data;
//     }
// } -->
