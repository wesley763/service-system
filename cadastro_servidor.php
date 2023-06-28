<?php
$exibirModal = false; // Define a variável para exibir o modal como falsa inicialmente

if (isset($_POST['submit'])) {
    include_once('configuracao.php');

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];
    $profissao = $_POST['profissao'];

    $result = mysqli_query($conexao, "INSERT INTO servidores(nome,cpf,senha,email,telefone,cidade,estado,endereco,profissao) 
        VALUES ('$nome','$cpf','$senha','$email','$telefone','$cidade','$estado','$endereco', '$profissao')");

    if ($result) {
        // Cadastro realizado com sucesso
        $exibirModal = true;
    } else {
        // Erro ao cadastrar
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CADASTRO SERVIDOR | QUALISERVICE</title>
    <link rel="stylesheet" href="css/style_servidor.css" />
  </head>
  <body>
  <nav class="navbar">
    <img src="img\logo ret.png" alt="Logo" class="logo">
  </nav>
    <section>
     <!--  <div class="color"></div> -->
      <div class="color"></div>
     <!--  <div class="color"></div> -->
      <div class="box">
        <div class="square" style="--i: 0;">
          <img src="img/logo Grande branca.png" width="100" height="100" />
        </div>
        <div class="square" style="--i: 1;">
          <img src="img/logo Grande branca.png." width="125" height="125" />
        </div>
        <div class="square" style="--i: 2;">
          <img src="img/logo Grande branca.png" width="80" height="80" />
        </div>
        <div class="square" style="--i: 3;">
          <img src="img/logo Grande branca.png" width="50" height="50" />
        </div>
        <div class="square" style="--i: 4;">
          <img src="img/logo Grande branca.png." width="60" height="60" />
        </div>
        <div class="container">
          <div class="form">
            <h2>Cadastro Servidor</h2>
            <form action="cadastro_servidor.php" method="POST">
              <div class="inputBox">
                <input type="text" name="nome" placeholder="Nome:" required/>
              </div>
              <div class="inputBox">
                <input type="email" name="email" placeholder="E-mail:" required/>
              </div>
              <div class="inputBox">
                <input type="profissao" name="profissao" placeholder="Profissão:" required/>
              </div>

              <div class="inputLinha">
                <div class="inputBox">
                  <input type="text" name="cpf" placeholder="Cpf:"required />
                </div>
                <div class="inputBox">
                  <input type="tel" name="telefone" placeholder="Telefone:" required/>
                </div>
                <div class="inputBox">
                  <input type="text" name="endereco" placeholder="Endereço:"required />
                </div>
              </div>
              <!-- fim liha  -->
              <div class="inputLinha">
                <div class="inputBox">
                  <input type="text" name="cidade" placeholder="Cidade:" required/>
                </div>
                <div class="inputBox">
                  <input type="text" name="estado" placeholder="Estado:"required />
                </div>
                <div class="inputBox">
                  <input type="password" name="senha" placeholder="Senha:" required/>
                </div>
              </div>

              <div class="inputBox">
                <input type="submit" name="submit" value="Cadastrar" />
              </div>
              <p class="forget">
                Já tem uma conta? <a href="login.php"> Entrar</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
        &copy; Copyrigth QUALISERVICE
    </footer>

    <!-- O modal -->
    <?php if ($exibirModal) { ?>
    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Cadastro realizado com sucesso!!</h2>
            <p>O seu cadastro foi realizado com sucesso.</p>
        </div>
    </div>

    <style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        border: 1px solid black;
        border-radius: 5px;
        padding: 20px;
        width: 50%;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    </style>

    <script>
    // Função para fechar o modal
    function closeModal() {
        document.querySelector(".modal").style.display = "none";
    }

    // Fecha o modal quando o botão de fechar é clicado
    document.querySelector(".close").addEventListener("click", closeModal);

    // Fecha o modal após 3 segundos
    setTimeout(closeModal, 3000);
    </script>
    <?php } ?>
  </body>
</html>
