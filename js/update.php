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

$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
$rg = mysqli_real_escape_string($conn, $_POST['RG']);
$cep = mysqli_real_escape_string($conn, $_POST['CEP']);
$ende = mysqli_real_escape_string($conn, $_POST['Endereco']);
$cidade = mysqli_real_escape_string($conn, $_POST['Cidade']);
$estado = mysqli_real_escape_string($conn, $_POST['Estado']);
$numero = mysqli_real_escape_string($conn, $_POST['Numero']);
$email = mysqli_real_escape_string($conn, $_POST['Email']);
$senha = mysqli_real_escape_string($conn, $_POST['Senha']);
$nome_foto = "";
$ID = mysqli_real_escape_string($conn, $_POST['ID']);

if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

    $nome_foto = $_FILES['foto']['name'];
    $caminho_foto = "caminho/para/salvar/fotos/" . $nome_foto;

    if(move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {

        $nome_foto = mysqli_real_escape_string($conn, $nome_foto);
    } else {

        echo "Erro ao enviar a imagem";
        exit;
    }
} else {
    
    $nome_foto = "";
}

// Capturar os novos valores dos campos
date_default_timezone_set('America/Sao_Paulo');
$hora = date('d/m/Y H:i:s');
$sqlquery = "UPDATE clientes SET
NOME = '$nome', CPF = '$cpf', RG = '$rg', CEP = '$cep', END = '$ende', CIDADE = '$cidade', UF = '$estado', NUM = '$numero', LOGIN = '$email', Senha = '$senha', FOTO = '$nome_foto', Horario = '$hora' WHERE ID = $ID ";

if($nome_foto != "") {
    // Adiciona a atualização da foto se um novo arquivo foi enviado
    $sqlquery .= ", FOTO = '$nome_foto'";
}

if (mysqli_query($conn, $sqlquery)) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Error: " . $sqlquery . "<br>" . mysqli_error($conn);
}

$conn->close();
?>