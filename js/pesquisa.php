<?php
require_once("conexao.php");

$valorProcurado = $_POST['pesquisa'];
if(!isset($valorProcurado) || empty($valorProcurado)) return json_encode(["Erro"=>"Campo de busca vazio"]);

$sqlquery = "SELECT *  FROM clientes WHERE NOME = '$valorProcurado' or CPF = '$valorProcurado' or RG = '$valorProcurado'";


if ($conn->query($sqlquery)) {
    $result = $conn->query($sqlquery);
    $dados = $result->fetch_assoc();
    echo json_encode($dados);

} else {
    echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

// Closing the connection.
$conn->close();
 
?>