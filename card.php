<html>
<head>
  <title>SERVIÇOS</title>

  <style>
    /* Estilos para o cabeçalho */
    header {
      background-color: #f1f1f1;
      padding: 0px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      width: 150px;
      /* Defina a largura da imagem */
      height: 150px;
      /* Mantém a proporção da imagem */
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
      height: 490px;
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
      margin: 0 auto; /* Adiciona margem automática nas laterais para centralizar horizontalmente */
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
      border-bottom: none; /* Remover a linha abaixo do texto */
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
  <div class="search-container">
    <form method="GET" action="">
      <input type="text" placeholder="Pesquisar..." name="search">
      <div class="search-icon">
        <i class="fas fa-search"></i>
      </div>
    </form>
  </div>
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

  // Obter o valor da pesquisa do parâmetro GET
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  // Consulta SQL para recuperar os serviços com o nome da categoria e filtrar a pesquisa
  $sql = "SELECT S.*, SV.nome as nome_servidor, SV.telefone, SV.profissao, C.nome as nome_categoria
          FROM servico as S
          JOIN servidores as SV ON S.servidores_idservidores = SV.idservidores
          JOIN categoria as C ON S.categoria_idcategoria = C.idcategoria
          WHERE S.nome LIKE '%$search%' OR S.descricao LIKE '%$search%'";

  $resultado = mysqli_query($conexao, $sql);

  // Verificar se a consulta retornou resultados
  if (mysqli_num_rows($resultado) > 0) {
    // Loop para exibir os dados
    echo "<div id='container'>";
    while ($row = mysqli_fetch_assoc($resultado)) {
      echo "<div class='card'>";
      echo "<img src='" . $row['foto'] . "' alt='Imagem do serviço'>";
      echo "<div class='card-content'>";
      echo "<h3>Servidor: " . substr($row['nome_servidor'], 0, 10) . "</h3>";
      echo "<h3>Serviço: " . substr($row['nome'], 0, 10) . "</h3>";
      echo "<h3>Categoria: " . substr($row['nome_categoria'], 0, 10) . "...</h3>";
      echo "<h3>Telefone: " . substr($row['telefone'], 0, 10) . "</h3>";
      echo "<h3>Valor: R$" . substr($row['valor'], 0, 10) . "</h3>";
      echo "<h3>Descrição: " . substr($row['descricao'], 0, 10) . "</h3>";
      echo "<h3>Profissão: " . substr($row['profissao'], 0, 10) . "</h3>";
      echo "<div class='button-container'>";
      echo "<button class='whatsapp-button'><a href='https://wa.me/{$row['telefone']}' target='_blank'>WhatsApp</a></button>";
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
</body>
</html>
