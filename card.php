<html>
<head>
  <title>SERVIÇOS</title>
  <link rel="stylesheet" href="css/ver_servico.css">
</head>

<body>
<nav class="navbar">
        <img src="img\logo ret.png" alt="Logo" class="logo">
        <div class="search-container">
        <form method="GET" action="">
            <input type="text" placeholder="Pesquisar..." name="search">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
        </form>
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
      echo "<button class='whatsapp-button'><a href='https://wa.me/+55{$row['telefone']}' target='_blank'>WhatsApp</a></button>";
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
