<!-- Nome:
CPF:
RG:
Endereço: (auto preencher o endereço com base no CEP digitado)
Nº
E-mail:
Envio de arquivo: (pdf, doc, png)
Gravar a data e hora da inclusão do registro e exibir no form -->
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de cliente</title>
  <link rel="stylesheet" href="estilos/style.css">
  <link rel="stylesheet" href="estilos/media-query.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <main>

    <section id="login">
      <p id="aparecerAdm" style="display: block;text-align: center">Acesso administrador
      <?php if (isset($_SESSION["login"])) echo $_SESSION["login"] ?> </p>
   
      <div id="campos">

        <input class="administrador" id="ilogin" type="email" name="logar" placeholder="Seu e-mail. Caracteres especiais apenas . _ @ -" autocomplete="email" required maxlength="60"><br>
        <input class="administrador" type="password" name="acesso" id="isenha" placeholder="Sua senha. Caracteres especiais apenas . _ @ -" autocomplete="current-password" required minlength="8" maxlength="20">
        <input id="abrir" type="button" value="Entrar">

      </div>
      <div id="modal" style= "display: none;" class="modal">
        <div class="modal-content">
          <h1 style="display: none;">Informações geradas!</h1>
          <button id="sair" value="Sair"></button> 
      </div>
      </div>


      <h1 id="clientes">Cadastro de Clientes</h1>
      <div id="cadastro">
        <p id="buscar"><b><i>Cadastre-se ou realize a busca!!</i></b></p>
        <input id="pesquisa" type="text" name="pesquisa" placeholder="Pesquise por: Nome completo, RG ou CPF">
        <i id="icon" class="fa-solid fa-magnifying-glass-plus"></i>

        <form id="form1" action="login.php" method="POST" enctype="multipart/form-data" autocomplete="on">

          <input class="validacao" id="Nome" type="text" name="nome" placeholder="Digite seu nome completo..." contenteditable="false" required>
          <input class="validacao" id="cpf" type="text" name="CPF" placeholder="Digite o número do seu CPF utilizando:XXX.XXX.XXX-XX" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" contenteditable="false" required>
          <input class="validacao" id="RG" type="text" name="RG" placeholder="Número do seu RG...." contenteditable="false" required>
          <input class="validacao" id="Cep" type="text" name="CEP" placeholder="Digite o seu CEP...." contenteditable="false" required>
          <input class="validacao" id="End" type="text" name="Endereco" placeholder="Seu endereço...." contenteditable="false">
          <input class="validacao" id="cidade" type="text" name="Cidade" placeholder="Sua cidade...." contenteditable="false">
          <input class="validacao" id="UF" type="text" name="Estado" placeholder="Seu Estado...." contenteditable="false">
          <input class="validacao" id="Num" type="text" name="Numero" placeholder="Digite o Nº...." contenteditable="false">
          <input class="validacao" id="Email" type="email" name="Email" placeholder="Seu e-mail...." autocomplete="email" required maxlength="60" contenteditable="false">
          <input id="senha" class="validacao" type="password" name="Senha" placeholder="Cadastre-se sua senha com máximo 20 caracteres...." required maxlength="20" contenteditable="false">
          <input id="foto" class="validacao" type="file" name="foto" accept=".jpg, .jpeg, .png, .gif" contenteditable="false" required>
          <div class="btn-list">
            <input id="enviar" style="display: block;" type="submit" name="enviar-formulario" value="Enviar">
            <input id="Atualizar" style="display: none" type="button" name="atualizar" value="Atualizar">
            <input id="Apagar" type="button" style="display: none;" name="Apagar" value="Apagar">
          </div>
          <p id="relogio" style="font-size: 18px;"></p>

        </form>
        <input id="unico" type="hidden">
        <script src="jquery-3.6.2.js"></script>
        <script>
          //Validar CEP
          $(document).ready(function() {
            $("#Cep").blur(function() {
              let valor = $(this).val();
              $.ajax({
                url: "https://viacep.com.br/ws/" + valor + "/json/",
                type: "GET",
                success: function(dados, status) {
                  if (dados.erro) {
                    alert('CEP incorreto, digite um CEP válido');
                  } else {
                    $("#End").val(dados.logradouro);
                    $("#cidade").val(dados.localidade);
                    $("#UF").val(dados.uf);
                  }
                },
                error: function() {
                  alert('Ocorreu um erro ao consultar o CEP. Tente novamente mais tarde.')
                }
              })
            })
          });
          const abrirModal = document.getElementById('abrir')
          const modal = document.getElementById('modal');
          const sair = document.getElementById('sair');

          abrirModal.addEventListener('click', function(){
            modal.style.display = 'block';
          })
          
          sair.addEventListener('click', function(){
            modal.style.display = 'none';
          })

          // Trecho da validação da foto
          const form = document.querySelector("form");
          const form2 = $("#form1");
          form.addEventListener("submit", function(event) {
            event.preventDefault();

            const formatosPermitidos = ["png", "jpeg", "jpg", "gif", "doc"];
            const arquivo = document.querySelector('input[type="file"]').files[0];
            const extensao = arquivo.name.split(".").pop();
            if (formatosPermitidos.includes(extensao)) {} else {
              alert("Formato inválido, selecionar formato válido!!")
            }


            //Validação dos inputs
            const validar = document.getElementsByClassName("validacao");
            const values = [];
            for (let i = 0; i < validar.length; i++) {
              if (validar[i].value) {
                values.push("\n" + validar[i].value);
              }

            }
            if (values.length === validar.length) {

              const date = new Date();
              alert("Todos os campos estão preenchidos" + "\nData e hora: " + date.toLocaleString());
              // console.log("Dados salvos em: " + "\n" + values + "\n" + "\nData e Hora: " + date.toLocaleString())
              mostrarHora()

              let fd = new FormData();
              fd.append("foto", arquivo);
              let inputs = form2.children();
              for (let element of inputs) {
                if (element.classList.contains("validacao")) {
                  fd.append(element.name, element.value)
                }
              }

              $.ajax({
                url: "./login.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function() {
                  location.reload()

                }
              })
            };

          })

          //   function verificarSenha(){
          //   const senha = document.getElementById('senha')
          //   senha.addEventListener('blur', function() {
          //     const regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
          //     if (regexSenha.test(senha.value)) {
          //       // console.log("Senha forte");
          //       alert("Senha Forte")
          //     } else {
          //       // console.log("Verificar senha");
          //       alert("Verificar senha");
          //     }
          //   });
          // }
          //Horario no form

          const mostrarHora = function() {
            const relogio = document.getElementById('relogio');

            if (!relogio) {
              console.error('Elemento relógio não encontrado na página');
              return;
            }

            relogio.innerHTML = "00:00:00";
            clock();
          };

          const clock = function() {
            const agora = new Date();

            let horas = agora.getHours();
            let minutos = agora.getMinutes();
            let segundos = agora.getSeconds();

            if (horas < 10) {
              horas = '0' + horas;
            }
            if (minutos < 10) {
              minutos = '0' + minutos;
            }
            if (segundos < 10) {
              segundos = '0' + segundos;
            }

            const montar_relogio = ("Dados salvo às: ") + horas + ':' + minutos + ':' + segundos;
            const relogio = document.getElementById('relogio');
            relogio.innerText = montar_relogio;
          };

          const abrir = document.getElementById('abrir');

          abrir.addEventListener('click', function() {
            
            const regex = /^[a-zA-Z0-9._@-]+$/;

            let login = document.getElementById('ilogin').value;
            let senha = document.getElementById('isenha').value

            if (!!regex.test(login) && !!regex.test(senha)) {
              const campos2 = $("#campos");
              let fd = new FormData();
              fd.append("logar", login);
              fd.append("acesso", senha);
              aparecerAdm.style.display = "block"
              let inputs = campos2.children();
              for (let element of inputs) {
                if (element.classList.contains("administrator")) {
                  fd.append("logar", login)
                  fd.append("acesso", senha)

                }
              }

              $.ajax({
                url: "admin.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                  alert(response);

                  location.reload();
                  // aparecerAdm.style.display = "block"

                },

                error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert("Erro ao enviar dados para o servidor.");
                }
              });
            } else {
              alert("Campo inválido. Caracteres aceitos apenas: . - @ _")
            }

          });

          $(document).on('click', "#icon", function() {
            let valorProcurado = document.getElementById('pesquisa').value
            $.ajax({
              url: "pesquisa.php",
              method: "POST",
              data: {
                pesquisa: valorProcurado
              },
              success: function(retorno) {
                let dados = JSON.parse(retorno)
                if (dados) {
                  icon
                  document.getElementById('Nome').value = dados.NOME;
                  document.getElementById('cpf').value = dados.CPF;
                  document.getElementById('RG').value = dados.RG;
                  document.getElementById('Cep').value = dados.CEP;
                  document.getElementById('End').value = dados.END;
                  document.getElementById('cidade').value = dados.CIDADE;
                  document.getElementById('UF').value = dados.UF;
                  document.getElementById('Num').value = dados.NUM;
                  document.getElementById('Email').value = dados.LOGIN;
                  document.getElementById('senha').value = dados.Senha;
                  // document.getElementById('foto').value = dados.FOTO
                  document.getElementById('unico').value = dados.ID;

                  Atualizar.style.display = "block";
                  enviar.style.display = "none";
                  Apagar.style.display = "block"
                } else {
                  Editar.style.display = "none"
                  alert("Nenhum dado encontrado, realize seu cadastro!!")
                }
              }

            })
          })

          $(document).on('click', '#Atualizar', function() {

            let nome = $('#Nome').val();
            let cpf = $('#cpf').val();
            let rg = $('#RG').val();
            let cep = $('#Cep').val();
            let ende = $('#End').val();
            let cidade = $('#cidade').val();
            let estado = $('#UF').val();
            let numero = $('#Num').val();
            let email = $('#Email').val();
            let senha = $('#senha').val();
            let foto = $('#foto').val();
            let ID = $('#unico').val();

            $.ajax({

              url: 'update.php',
              method: 'POST',
              data: {
                nome: nome,
                cpf: cpf,
                RG: rg,
                CEP: cep,
                Endereco: ende,
                Cidade: cidade,
                Estado: estado,
                Numero: numero,
                Email: email,
                Senha: senha,
                foto: foto,
                ID: ID
              },
              success: function(response) {
                alert("Dados atualizados com sucesso.")
                mostrarHora()
                location.reload()
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert("Ocorreu um erro.")
              }
            })
          });

          const Apagar = document.getElementById('Apagar')
          Apagar.addEventListener('click', function() {

            let ID = $('#unico').val();

            $.ajax({

              url: 'apagar.php',
              method: 'POST',
              data: {
                ID: ID
              },
              success: function(response) {
                if (response) {
                  alert("Tem certeza que deseja apagar seus dados")
                } else {
                  alert("Dados apagados com sucesso.")
                  mostrarHora()
                  location.reload()
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert("Ocorreu um erro, tente novamente!")
              }
            })

          })
        </script>
      </div>
    </section>
  </main>
</body>

</html>