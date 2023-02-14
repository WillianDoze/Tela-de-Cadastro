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
 
// Verifica se todos os campos obrigatórios foram preenchidos
if (!isset($_POST['nome']) || empty($_POST['nome']) ||
    !isset($_POST['CPF']) || empty($_POST['CPF']) ||
    !isset($_POST['RG']) || empty($_POST['RG']) ||
    !isset($_POST['CEP']) || empty($_POST['CEP']) ||
    !isset($_POST['Endereco']) || empty($_POST['Endereco']) ||
    !isset($_POST['Cidade']) || empty($_POST['Cidade']) ||
    !isset($_POST['Estado']) || empty($_POST['Estado']) ||
    !isset($_POST['Numero']) || empty($_POST['Numero']) ||
    !isset($_POST['Email']) || empty($_POST['Email']) ||
    !isset($_POST['foto']) || empty($_POST['foto'])) {
    echo "Erro: Todos os campos obrigatórios devem ser preenchidos.";
    exit();
}

// Escapa as variáveis recebidas do formulário para evitar SQL injection
$foto = mysqli_real_escape_string($conn, $_POST['foto']);
$Email = mysqli_real_escape_string($conn, $_POST['Email']);

// Prepara a consulta SQL com parâmetros de espaço reservado
$stmt = $conn->prepare("INSERT INTO clientes (nome, CPF, RG, CEP, Endereco, Cidade, Estado, Numero, Email, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Vincula os valores de entrada aos parâmetros da consulta preparada
$stmt->bind_param("ssssssssss", $_POST['nome'], $_POST['CPF'], $_POST['RG'], $_POST['CEP'], $_POST['Endereco'], $_POST['Cidade'], $_POST['Estado'], $_POST['numero'], $Email, $foto);

// Executa a consulta preparada
if ($stmt->execute()) {
    echo "Registro inserido com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

// Fecha a consulta e a conexão com o banco de dados
$stmt->close();
$conn->close();

?> -->
