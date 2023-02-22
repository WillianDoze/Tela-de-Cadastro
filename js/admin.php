<?php
require_once("conexao.php");

$login = $_POST['logar'];
$password = $_POST['acesso'];

 $sqlquery = "INSERT INTO administrator VALUES
 EmailAdm = '$login', SenhaADM = '$password'";

if ($conn->query($sqlquery) === TRUE) {
  echo "record inserted successfully";
} else {
  echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

 // Verifica se o usuário existe no banco de dados e se a senha está correta
 if (verificar_credenciais($acessar, $password)) {
   // Iniciar uma sessão para o usuário
   session_start();
   $_SESSION['acessar'] = $acessar;

 
   // Redirecionar para a página de administração
   header('Location: admin.php');
 } else {
   // Se as credenciais forem inválidas, exibir uma mensagem de erro
   echo json_encode(array('ok' => false));
 }
 
 function verificar_credenciais($acessar, $password) {
   // Substitua esta função pela sua própria lógica de verificação de credenciais
   // Aqui está um exemplo simples que verifica se o usuário e a senha são iguais a "admin"
   return $acessar === 'wfdirceu@gmail.com' && $password === 'senha@123';
 }
 // Closing the connection.
$conn->close();
?>