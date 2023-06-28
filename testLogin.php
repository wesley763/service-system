<?php
session_start();
include_once('configuracao.php');
//include('modal.php');

// print_r($_REQUEST);
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa
    
    
    $email = $_POST['email'];

    $senha = $_POST['senha'];

    print_r('Email: ' . $email);
    print_r('<br>');
    print_r('Senha: ' . $senha);

    $sql = "SELECT * FROM servidores WHERE email = '$email' and senha = '$senha'";

    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        
        header('Location: login.php?error=1');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $idUsuario = $_SESSION['id_servidores'];
        header('Location: paginaLogada.php');
    }
}
    else
    {
    echo $modal;
    /* header('Location: inicio.php '); */
    }

?>