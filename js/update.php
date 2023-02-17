<?php
// Inclua o arquivo de conexão com o banco de dados
require_once("conexao.php");

// Capturar os novos valores dos campos
$nome = $_POST['nome'];
$cpf = $_POST['CPF'];
$rg = $_POST['RG'];
$cep = $_POST['CEP'];
$endereco = $_POST['Endereco'];
$cidade = $_POST['Cidade'];
$uf = $_POST['Estado'];
$numero = $_POST['Numero'];
$email = $_POST['Email'];
$senha = $_POST['Senha'];
$foto = $_POST['foto'];

// Atualizar os dados no banco de dados
$sqlquery = "UPDATE clientes SET ('$_POST[nome]', '$_POST[CPF]', '$_POST[RG]', '$_POST[CEP]', '$_POST[Endereco]', '$_POST[Cidade]', '$_POST[Estado]', '$_POST[Numero]', '$_POST[Email]', '$_POST[Senha]', '$hora', '')";
if ($conn->query($sqlquery) === TRUE) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>