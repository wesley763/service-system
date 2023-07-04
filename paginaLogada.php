<?php
session_start();
include_once('configuracao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    $id_servidor_logado = $_SESSION['servidores_idservidores'];
    exit;
}

$email = $_SESSION['email'];
$senha = $_SESSION['senha'];

// Consultar o banco de dados para obter o nome do usuário logado
$consulta = mysqli_query($conexao, "SELECT nome, idservidores FROM servidores WHERE email = '$email'");
if ($consulta && mysqli_num_rows($consulta) > 0) {
    $dados = mysqli_fetch_assoc($consulta);
    $nomeLogado = $dados['nome'];
    $_SESSION['servidores_idservidores'] = $dados['idservidores'];
} else {
    // Tratar erro se o email não existir no banco de dados
    $nomeLogado = 'Usuário Desconhecido';
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?><!DOCTYPE html>
<html>
<head>
    <title>Meus Serviços</title>
    <style>
        /* Estilos para o cabeçalho */
        @import url('https://fonts.googleapis.com/css2?family-Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow: hidden;
        }

        header {
            background-color: #f1f1f1;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navigation {
            display: flex;
        }

        .navigation a {
            margin-right: 10px;
            text-decoration: none;
            color: white;
        }

        h1 {
            text-align: center;
        }

        button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgba(0, 0, 156, 0.91);
            color: whitesmoke;
        }

        button a {
            text-decoration: none;
            color: white;
            text-align: center;
            font-weight: 300;
            padding: 20px;
        }

        header button {
            display: block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        header button:hover {
            background-color: rgba(0, 0, 156, 0.91);
            color: whitesmoke;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            background: rgba(0, 0, 156, 0.91);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        /* Estilos para o modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .modal h2 {
            margin-bottom: 20px;
        }

        .modal button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal button:hover {
            background-color: rgba(0, 0, 156, 0.91);
            color: whitesmoke;
        }

        .modal button + button {
            margin-left: 10px;
        }

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

    </style>
</head>

<body>
    <header>
        <img src="img\logo Grande.png" alt="Logo" class="logo">

        <nav class="navigation">
            <button><a href="inicio.php">Página Inicial</a></button>
            <button><a href="sobre.php">Sobre</a></button>
            <button onclick="showLogoutModal()">Sair</button>
        </nav>
    </header>

    <h1>Olá, <?php echo $nomeLogado; ?></h1>
    <br> 
    <br>   
    <br> 
    <br> 
    <h1>Meus Serviços</h1>

    <br> 
    <br> 

    <button><a href="cadastro_service.php">Cadastrar Serviços</a></button>
    <br> 
    
    <button><a href="meus_servico.php">Ver Meus Serviços</a></button>

    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <h2>Deseja realmente sair?</h2>
            <form method="post">
                <button type="submit" name="logout">Confirmar</button>
                <button type="button" onclick="hideLogoutModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <footer class="footer" style="background: rgba(0, 0, 156, 0.91);">
        &copy; Copyrigth QUALISERVICE
    </footer>

    <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
    </script>
</body>
</html>
