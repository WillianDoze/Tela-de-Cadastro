<?php
require_once("conexao.php");


$sqlquery = "SELECT * FROM administrator WHERE EmailAdm = '".$_POST["logar"]."' AND SenhaAdm = '".$_POST["acesso"]."'";
$login = $_POST['logar'];
$password = $_POST['acesso'];
if ($conn->query($sqlquery)) {
  $query = $conn->query($sqlquery);
  $resultado = $query->fetch_assoc();
  if($resultado && count($resultado)){
    echo "Acessando.......";
    session_start();
   $_SESSION['login'] = $resultado["NomeAdm"];
   
  }
  else{
    echo "Acesso negado, apenas administrador pode acessar essa página.";
  }
} else {
  echo "Error: " . $sqlquery . "<br>" . $conn->error;
}

// $login = $_POST['logar'];
// $password = $_POST['acesso'];

//  // Verifica se o usuário existe no banco de dados e se a senha está correta
//  if (verificar_credenciais($login, $password)) {
//    // Iniciar uma sessão para o usuário
//    session_start();
//    $_SESSION['login'] = $login;
//    $_SESSION['senha'] = $password;

 
//    // Redirecionar para a página de administração
//    header('Location: admin.php');
//  } else {
//    // Se as credenciais forem inválidas, exibir uma mensagem de erro

//  }
 
//  function verificar_credenciais($login, $password) {
//     if($login == 'wfdirceu@gmail.com' && $password === 'senha@123'){
//       echo "Acessando.......";
//     }else{
//       echo "Acesso negado, apenas administrador pode acessar essa página.";
//     }
  
//  }
 // Closing the connection.
$conn->close();
?>