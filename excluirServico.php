<?php
// Conexão com o banco de dados
include_once('configuracao.php');

// Verificar a conexão
if (mysqli_connect_errno()) {
  echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
  exit();
}

// Verificar se o parâmetro de ID foi fornecido na URL
if (isset($_GET['id'])) {
  $id_servico = $_GET['id'];

  // Consulta SQL para excluir o serviço com o ID fornecido
  $sql = "DELETE FROM servico WHERE idservico = $id_servico";

  // Executar a consulta
  if (mysqli_query($conexao, $sql)) {
    echo "Serviço excluído com sucesso.";
  } else {
    echo "Erro ao excluir o serviço: " . mysqli_error($conexao);
  }
} else {
  echo "ID do serviço não fornecido.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
