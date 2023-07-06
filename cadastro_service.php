<?php
session_start();

if (isset($_POST['submit'])) {
    include_once('configuracao.php');

    $nome = $_POST['nome'];
    $categoria_idcategoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

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

    // Upload da foto
    $foto = $_FILES['foto'];

    // Verificar se um arquivo foi enviado
    if ($foto['name']) {
        $foto_nome = $foto['name'];
        $foto_tmp = $foto['tmp_name'];
        $foto_destino = 'img/' . $foto_nome;

        // Mover o arquivo para a pasta de destino
        if (move_uploaded_file($foto_tmp, $foto_destino)) {
            // Inserir os dados do serviço na tabela "servico"
            $query = "INSERT INTO servico (nome, descricao, valor, foto, categoria_idcategoria, servidores_idservidores) 
                    VALUES ('$nome', '$descricao', '$valor', '$foto_destino', '$categoria_idcategoria', '$idServidor')";
            $result = mysqli_query($conexao, $query);

            if ($result) {
                header('Location: paginaLogada.php');
                exit();
            } else {
                echo "Ocorreu um erro ao cadastrar o serviço.";
            }
        } else {
            echo "Erro ao enviar a foto. Verifique as permissões de escrita na pasta 'img'.";
        }
    } else {
        // Nenhum arquivo foi enviado
        echo "Nenhuma foto foi selecionada.";
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
</style>

<body>

    <nav class="navbar">
        <img src="img\logo ret.png" alt="Logo" class="logo">

        <div style="margin-left:auto ;">
            <button><a href="inicio.php">Página Inicial</a></button>
            <button><a href="sobre.php">Sobre</a></button>
            <button onclick="showLogoutModal()">Sair</button>
        </div>
    </nav>


    <section>
        <!-- Conteúdo da seção -->
        <div class="container">
            <div class="form">
                <h2>Cadastro de Serviços</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Campos de formulário -->
                    <div class="inputBox">
                        <input type="text" name="nome" placeholder="Serviço:">
                    </div>
                    <div class="inputBox">
                        <select name="categoria" required>
                            <option value="">Selecione uma categoria:</option>
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria['idcategoria']; ?>"><?php echo $categoria['nome']; ?>
                                </option>
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
                        <input type="file" name="foto" accept="image/*" required>
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