<?php
    include_once('../conexao.php');
    session_start(); 

    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(!isset($_POST['usuario']) || !isset($_POST['senha'])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Usuário e senha são obrigatórios.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    $usuario_form = $_POST['usuario'];
    $senha_form = $_POST['senha'];

    $stmt = $conexao->prepare("SELECT id_pessoa, usuario, nome FROM Usuarios WHERE usuario = ? AND senha = ?");
    $stmt->bind_param("ss", $usuario_form, $senha_form);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        $usuario_db = $resultado->fetch_assoc();

        $_SESSION['id_pessoa'] = $usuario_db['id_pessoa'];
        $_SESSION['usuario'] = $usuario_db['usuario'];
        $_SESSION['nome'] = $usuario_db['nome'];

        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Login efetuado com sucesso.'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Usuário ou senha inválidos.'
        ];
    }

    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
