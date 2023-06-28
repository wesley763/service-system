<?php
$modal = '
    <div class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Erro de login</h3>
        <p id="n">Email ou senha incorretos.</p>
      </div>
    </div>
    
    <style>
    #n{
      background-color:initial;
    }
    .modal {
     
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;

    }
   
   .modal h2{
      color: black;
      margin-top: -2%;

    }
    
    .modal-content {
      text-alingner:center;
      background-color: white;
      border: 1px solid black;
      border-radius: 5px;
      margin: auto;
      width: 100%;
      height: auto;x
      color: black;

  }
    
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    </style>
    
    <script>
      const modal = document.querySelector(".modal");
      const closeButton = document.querySelector(".close");
    
      closeButton.addEventListener("click", () => {
        modal.style.display = "none";
      });
    
      modal.style.display = "block";
      setTimeout(() => {
        modal.style.display = "none";
      }, 3000);
    </script>
    ';
    
      
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | QUALISERVICE </title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <!-- pagina meio -->
    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="square" style="--i:0;"><img src="img/logo Grande branca.png" width="100" height="100" />
            </div>
            <div class="square" style="--i:1;"><img src="img/logo Grande branca.png." width="125" height="125" />
            </div>
            <div class="square" style="--i:2;"><img src="img/logo Grande branca.png" width="80" height="80" />
            </div>
            <div class="square" style="--i:3;"><img src="img/logo Grande branca.png" width="50" height="50" />
            </div>
            <div class="square" style="--i:4;"><img src="img/logo Grande branca.png." width="60" height="60" />
            </div>
            <!-- Formulario -->
            <div class="container">
                <div class="form">
                    <h2>Login </h2>
                    <form action="testLogin.php" method="POST">
                        <div class="inputBox">
                            <input type="text"name="email" placeholder="Usuario:" required>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="senha" placeholder="Senha:" required>
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="submit" value="Login">
                        </div>
                        <?php if(isset($_GET['error'])){
        echo $modal;
        
    }
                    ?>    
                        <!-- <p class="forget">Esqueceu a senha? <a href="#">Clique aqui</a></p> -->
                        <p class="forget">não tem conta?<a href="cadastro_servidor.php">inscrever-se</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>



