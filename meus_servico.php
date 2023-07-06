<html>

<head>
  <title>SERVIÇOS</title>

  <style>
    .navbar button a {
      color: white;
      text-decoration: none;
    }

    body {
      margin: 0;
      padding: 0;
      color: black;
      font-family: 'montserrat', sans-serif;
    }

    .navbar {
      background-color: lightgrey;
      padding: 20px;

    }


    .logo {
      width: 250px;
      padding-left: 20px;
      margin-right: 10px;
    }

    .navbar button {
      justify-content: end;
      position: relative;
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


    .navbar button:hover {
      background-color: rgba(0, 0, 156, 0.91);
      color: whitesmoke;
    }

    #container {
      display: flex;
      flex-wrap: wrap;
      padding: 4%;
    }

    .card {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      width: 230px;
      height: 450px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background: rgba(0, 0, 156, 0.91);
      transition: box-shadow 0.3s ease;
      margin-left: 20px;
    }

    .card:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card img {
      width: 100%;
      height: 200px;
      border-radius: 5px;
    }

    .card-content {
      padding: 10px;
    }

    .card h3 {
      margin-top: 10px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      font-size: 15px;
      color: #ffffff;
    }

    .card button {
      display: block;
      text-align: center;
      width: 100px;
      padding: 10px;
      background-color: #25D366;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .card1 button {
      display: block;
      text-align: center;
      width: 100px;
      padding: 10px;
      background-color: #25D366;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .card button:hover {
      background-color: #34B7F1;
    }

    .search-container {
      margin-top: 20px;
      margin-bottom: 20px;
      position: relative;
    }

    .search-container input[type="text"] {
      padding: 10px 40px 10px 10px;
      width: 100%;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .search-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      pointer-events: none;
    }

    .search-icon i {
      font-size: 20px;
      color: #777;
    }

    .whatsapp-button {
      text-decoration: none;
      color: white;
      text-align: center;
      font-weight: 300;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .delete-button {
      text-decoration: none;
      background-color: red;
      color: white;
      text-align: center;
      font-weight: 300;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <img src="img\logo ret.png" alt="Logo" class="logo">

    <div style="margin-left:1200 ;">
      <button><a href="inicio.php">Página Inicial</a></button>
      <button><a href="sobre.php">Sobre</a></button>
      <button onclick="showLogoutModal()">Sair</button>
    </div>
  </nav>

  <?php
  // Iniciar a sessão
  session_start();

  // Verificar se o servidor está logado na sessão
  

  // Conexão com o banco de dados
  include_once('configuracao.php');

  // Verificar a conexão
  if (mysqli_connect_errno()) {
    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
    exit();
  }

  // Obter o ID do servidor logado na sessão
  $id_servidor_logado = $_SESSION['servidores_idservidores'];

  // Consulta SQL para recuperar os serviços do servidor logado
  $sql = "SELECT * FROM servidores as S  WHERE S.idservidores = $id_servidor_logado";
  $sql2 = "SELECT * FROM servico as S  WHERE S.servidores_idservidores = $id_servidor_logado";

  $res = mysqli_query($conexao, $sql);
  $teste = mysqli_fetch_array($res);


  $resultado = mysqli_query($conexao, $sql);
  $resultado2 = mysqli_query($conexao, $sql2);
  // Verificar se a consulta retornou resultados
  if (mysqli_num_rows($resultado) > 0) {
    // Loop para exibir os dados
    echo "<div id='container'>";
    while (($row2 = mysqli_fetch_assoc($resultado2))) {
      echo "<div class='card'>";
      echo "<img src='" . $row2['foto'] . "' alt='Imagem do serviço'>";
      echo "<div class='card-content'>";
      echo "<h3>Nome: " . $row2['nome'] . "</h3>";
      echo "<h3>Valor: " . $row2['valor'] . "</h3>";
      echo "<h3>Descrição: " . $row2['descricao'] . "</h3>";
      echo "<h3>Profissão: " . $teste[3] . "</h3>";
      echo "<div class='button-container'>";
      echo "<button><a href='editarServico.php?id=" . $row2['idservico'] . "' class='whatsapp-button'>Editar</a></button>";
      echo "<button onclick='confirmDelete(" . $row2['idservico'] . ")' class='delete-button'>Excluir</button>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }

    echo "</div>";
  } else {
    echo "Nenhum serviço encontrado.";
  }

  // Fechar a conexão com o banco de dados
  mysqli_close($conexao);
  ?>

  <!-- Adicione o link para a biblioteca Font Awesome -->
  <script src="https://kit.fontawesome.com/xxxxxxxxxx.js" crossorigin="anonymous"></script>

  <script>
    function confirmDelete(servicoId) {
      if (confirm("Deseja excluir este serviço?")) {
        // Redirecionar para o script de exclusão passando o ID do serviço
        window.location.href = "excluirServico.php?id=" + servicoId;
      }
    }
  </script>
</body>

</html>