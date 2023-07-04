<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style_index.css">
  <title>Quali Service</title>
  <style>
    /* Estilos gerais */
    body {
      margin: 0;
      padding: 0;
    }

    /* Estilos para a barra de navegação */
    .navbar {
      background-color: lightgrey;
      padding: 20px;
      padding-right: 20px;
      display: flex;
      align-items: center;
      
    }

    .logo {
      width: 250px;
      padding-left: 20px;
      margin-right: 10px;
    }

    .nav-menu {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .nav-menu li {
      margin-right: 10px;
    }

    .nav-menu li a {
      text-decoration: none;
      color: #333;
      padding: 5px;
    }

    .login-link {
      margin-left: auto;
      text-decoration: none;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-weight: bold;
    }

    .login-link:hover {
      background-color: rgba(0, 0, 156, 0.91);
      color: whitesmoke;
    }

    .logo1 {
      width: 300px;
      height: 300px;
  }

    /* Restante do código CSS... */
  </style>
</head>

<body>
  <nav class="navbar">
    <img src="img\logo ret.png" alt="Logo" class="logo">
    <a href="login.php" class="login-link">Login</a>
  </nav>


  <header class="header-wrapper">
  <h1><img src="img\logo Grande.png" alt="Logo do Sistema" class="logo1"></h1>
    <h2>Divulgando para todos </h2>
    <div class="social-media">
      <!-- <a href="login.php" >Login</a> -->
      <a href="card.php">Ver Serviços</a>&nbsp;
      <a href="sobre.php">Sobre Nós</a>
    </div>
  </header>
  <div class="container">
    <div class="card-container">
      <div class="card-text">O Quali Serviços é uma plataforma online que conecta prestadores
         de serviços a clientes em busca de soluções profissionais. Nossa missão é facilitar
          a vida das pessoas, proporcionando acesso a uma ampla variedade de serviços de qualidade,
           desde assistência técnica e reformas, até consultorias e aulas particulares. 
      </div>
      <div class="card card1">
        <div class="card-wrapper">
          <h2>Projetos</h2>
          <p>Veja meus projetos!</p>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="card card2">
        <div class="card-wrapper">
          <h2>Projetos</h2>
          <p>Vem ver minha carreira profissional!</p>
        </div>
      </div>
      <div class="card-text">Com uma interface intuitiva e recursos avançados de busca, os usuários
         podem encontrar facilmente os serviços desejados e entrar em contato direto com os prestadores. 
         Acreditamos no poder da tecnologia para transformar a maneira como as pessoas contratam serviços, 
         e estamos comprometidos em oferecer uma experiência confiável, conveniente e satisfatória para todos
          os envolvidos
      </div>
    </div>

    <div class="card-container">
      <div class="card-text">Seja você um profissional em busca de novos clientes ou alguém em busca 
        de uma solução profissional, o Quali Serviços está aqui para ajudar a conectar pessoas e promover 
        o sucesso mútuo.
      </div>
      <div class="card card3 ">
        <div class="card-wrapper">
          <h2>Projetos</h2>
          <p>Ou mais do meu dia-a-dia ;)</p>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    &copy; Copyrigth QUALISERVICE
  </footer>
</body>

</html>