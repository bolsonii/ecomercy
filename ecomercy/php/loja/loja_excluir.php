<?php
    include_once('../conexao.php');
    session_start();

    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(!isset($_POST['id_loja'])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'É necessário informar um ID para exclusão.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    if(!isset($_SESSION['id_pessoa'])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Usuário não autenticado.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    $id_pessoa = $_SESSION['id_pessoa'];
    $id_loja = (int)$_POST['id_loja'];

    $stmt = $conexao->prepare("DELETE FROM Loja WHERE id_loja = ? AND id_pessoa = ?");
    $stmt->bind_param("ii", $id_loja, $id_pessoa);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Loja excluída com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Loja não encontrada ou você não tem permissão para excluí-la.'
        ];
    }

    $stmt->close();
    $conexao->close();
    
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>

