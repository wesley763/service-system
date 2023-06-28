<?php
session_start();

if (isset($_POST['submit'])) {
    include_once('configuracao.php');

    $nome = $_POST['nome'];
    $categoria_idcategoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $foto = $_POST["foto"];
   
    // Verificar se o usuário está logado
    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        header('Location: login.php');
        exit;
    }

    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];

    // Consultar o banco de dados para obter o ID do usuário logado
    $consulta = mysqli_query($conexao, "SELECT idServidores FROM servidores WHERE email = '$email'");
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        $dados = mysqli_fetch_assoc($consulta);
        $idServidor = $dados['idServidores'];
    } else {
        // Tratar erro se o email não existir no banco de dados
        $idServidor = null;
    }

    // Inserir os dados do serviço na tabela "servico"
    $query = "INSERT INTO servico (nome, descricao, valor, foto, categoria_idcategoria, servidores_idservidores) 
              VALUES ('$nome', '$descricao', '$valor', '$foto', '$categoria_idcategoria', '$idServidor')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        header('Location: paginaLogada.php');
        exit();
    } else {
        echo "Ocorreu um erro ao cadastrar o serviço.";
    }
}

// Obtém os dados da tabela "categoria"
include_once('configuracao.php');

$categorias_query = mysqli_query($conexao, "SELECT * FROM categoria");
$categorias = mysqli_fetch_all($categorias_query, MYSQLI_ASSOC);
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

<body>
    <header>
        <!-- Cabeçalho -->
    </header>

    <section>
        <!-- Conteúdo da seção -->
        <div class="container">
            <div class="form">
                <h2>Cadastro de Serviços</h2>
                <form action="" method="POST">
                    <!-- Campos de formulário -->
                    <div class="inputBox">
                        <input type="text" name="nome" placeholder="Serviço:">
                    </div>
                    <div class="inputBox">
                        <select name="categoria" required>
                            <option value="">Selecione uma categoria:</option>
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria['idcategoria']; ?>"><?php echo $categoria['nome']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="valor" placeholder="Valor:" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="descricao" placeholder="Descrição:" required>
                    </div>
                    <div class="inputBox">
                        <input type="file" name="foto" accept="img/*" required>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="submit" value="CADASTRAR">
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
