<?php
    include_once('../conexao.php');
    session_start();

    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(!isset($_SESSION['id_pessoa'])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Usuário não autenticado.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    if(!isset($_GET['id'])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'ID da loja não informado.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    $id_pessoa = $_SESSION['id_pessoa'];
    $id_loja = (int)$_GET['id'];
    $nome_loja = trim($_POST['nome_loja'] ?? '');
    $id_itens_input = (int)($_POST['id_itens'] ?? 0);

    $id_itens = ($id_itens_input > 0) ? $id_itens_input : NULL;

    if(empty($nome_loja)){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'O nome da loja não pode ser vazio.'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    $stmt = $conexao->prepare("UPDATE Loja SET nome_loja = ?, id_itens = ? WHERE id_loja = ? AND id_pessoa = ?");
    $stmt->bind_param("siii", $nome_loja, $id_itens, $id_loja, $id_pessoa);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Loja atualizada com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Falha ao atualizar a loja ou nenhum dado foi modificado.'
        ];
    }

    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>

