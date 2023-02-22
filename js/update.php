<?php

require_once("conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['RG'];
$cep = $_POST['CEP'];
$ende = $_POST['Endereco'];
$cidade = $_POST['Cidade'];
$estado = $_POST['Estado'];
$numero = $_POST['Numero'];
$email = $_POST['Email'];
$senha = $_POST['Senha'];
$nome_foto = $_FILES['foto']['name'];
$ID = $_POST['ID'];

// $nome = mysqli_real_escape_string($conn, $_POST['nome']);
// $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
// $rg = mysqli_real_escape_string($conn, $_POST['RG']);
// $cep = mysqli_real_escape_string($conn, $_POST['CEP']);
// $ende = mysqli_real_escape_string($conn, $_POST['Endereco']);
// $cidade = mysqli_real_escape_string($conn, $_POST['Cidade']);
// $estado = mysqli_real_escape_string($conn, $_POST['Estado']);
// $numero = mysqli_real_escape_string($conn, $_POST['Numero']);
// $email = mysqli_real_escape_string($conn, $_POST['Email']);
// $senha = mysqli_real_escape_string($conn, $_POST['Senha']);
// $nome_foto = mysqli_real_escape_string($conn,$_POST['foto']['name']);
// $ID = mysqli_real_escape_string($conn, $_POST['ID']);


// Capturar os novos valores dos campos
date_default_timezone_set('America/Sao_Paulo');
$hora = date('d/m/Y H:i:s');
$sqlquery = "UPDATE clientes SET
NOME = '$nome', CPF = '$cpf', RG = '$rg', CEP = '$cep', END = '$ende', CIDADE = '$cidade', UF = '$estado', NUM = '$numero', LOGIN = '$email', Senha = '$senha', FOTO = '$nome_foto', Horario = '$hora' WHERE ID = $ID ";

if (mysqli_query($conn, $sqlquery)) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Error: " . $sqlquery . "<br>" . mysqli_error($conn);
}

$conn->close();
?>