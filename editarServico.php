<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit;
}

include_once('configuracao.php');

// Verificar se o ID do serviço a ser editado foi fornecido na URL
if (isset($_GET['id'])) {
    $idServico = $_GET['id'];

    // Obter os dados do serviço do banco de dados
    $consulta = mysqli_query($conexao, "SELECT * FROM servico WHERE idservico = '$idServico'");
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        $dados = mysqli_fetch_assoc($consulta);
        $nome = $dados['nome'];
        $categoria_idcategoria = $dados['categoria_idcategoria'];
        $descricao = $dados['descricao'];
        $valor = $dados['valor'];
        $foto = $dados['foto'];
    } else {
        // Tratar erro se o serviço não existir no banco de dados
        // Redirecionar ou exibir uma mensagem de erro
    }
} else {
    // Redirecionar ou exibir uma mensagem de erro
}

$categorias_query = mysqli_query($conexao, "SELECT * FROM categoria");
$categorias = mysqli_fetch_all($categorias_query, MYSQLI_ASSOC);

// Processar o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Recuperar os valores do formulário
    $nome = $_POST['nome'];
    $categoria_idcategoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $foto = $_FILES['foto'];
    // Verificar se um novo arquivo de foto foi enviado
    if ($foto['name']) {
        $foto_nome = $foto['name'];
        $foto_tmp = $foto['tmp_name'];
        $foto_destino = 'img/' . $foto_nome;


        // Mover o arquivo para o destino desejado
        if (move_uploaded_file($foto_tmp, $foto_destino)) { 
            // Atualizar o nome do arquivo no banco de dados
            $atualizarFoto = mysqli_query($conexao, "UPDATE servico SET foto = '$foto_destino' WHERE idservico = '$idServico'");
            if (!$atualizarFoto) {
                // Tratar erro na atualização do nome do arquivo
                // Redirecionar ou exibir uma mensagem de erro
            }
        } else {
            // Tratar erro ao mover o arquivo
            // Redirecionar ou exibir uma mensagem de erro
        }
    }

    // Atualizar os outros dados no banco de dados
    $atualizar = mysqli_query($conexao, "UPDATE servico SET nome = '$nome', categoria_idcategoria = '$categoria_idcategoria', valor = '$valor', descricao = '$descricao' WHERE idservico = '$idServico'");

    if ($atualizar) {
        // Redirecionar para a página de listagem de serviços ou exibir uma mensagem de sucesso
        header('Location: meus_servico.php');
        exit;
    } else {
        // Tratar erro na atualização dos dados
        // Redirecionar ou exibir uma mensagem de erro
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUALISERVICE</title>
    <link rel="stylesheet" href="css/style_servidor.css" />
</head>
<style>
    /* Estilos para o cabeçalho */
    header {
        background-color: #f1f1f1;
        padding: 5px;
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

    /* Restante do código CSS... */
</style>

<body>
    <header>
        <img src="img\logo Grande.png" alt="Logo" class="logo">

        <nav class="navigation">
            <button><a href="inicio.php">Página Inicial</a></button>
            <button><a href="sobre.php">Sobre</a></button>
            <button><a href="meus_servico.php">Voltar</a></button>

        </nav>
    </header>

    <section>
        <!-- Conteúdo da seção -->
        <div class="container">
            <div class="form">
                <h2>Editar Serviço</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Campos de formulário -->
                    <div class="inputBox">
                        <input type="text" name="nome" placeholder="Serviço:" value="<?php echo $nome; ?>">
                    </div>
                    <div class="inputBox">
                        <select name="categoria" required>
                            <option value="">Selecione uma categoria:</option>
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria['idcategoria']; ?>" <?php if ($categoria['idcategoria'] == $categoria_idcategoria) echo 'selected'; ?>><?php echo $categoria['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="valor" placeholder="Valor:" value="<?php echo $valor; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="descricao" placeholder="Descrição:" value="<?php echo $descricao; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="file" name="foto" accept="image/*">
                    </div>

                    <div class="inputBox">
                        <input type="submit" name="submit" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        &copy; Copyrigth QUALISERVICE
    </footer>
</body>

</html>
