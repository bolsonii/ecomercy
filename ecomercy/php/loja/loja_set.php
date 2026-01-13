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

    $id_pessoa = $_SESSION['id_pessoa'];
    $nome_loja = $_POST['nome_loja'] ?? '';
    $id_itens_input = (int)($_POST['id_itens'] ?? 0);
    $tipo_loja = (int)($_POST['tipo_loja'] ?? 0);

    if(empty($nome_loja) || !in_array($tipo_loja, [1, 2])){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Dados inválidos (Nome ou Tipo).'
        ];
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }

    $id_itens = ($id_itens_input > 0) ? $id_itens_input : NULL;

    $check = $conexao->prepare("SELECT id_loja FROM Loja WHERE id_pessoa = ? AND tipo_loja = ?");
    $check->bind_param("ii", $id_pessoa, $tipo_loja);
    $check->execute();
    if($check->get_result()->num_rows > 0){
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Você só pode ter uma loja por vez.'
        ];
        $check->close();
        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }
    $check->close();

    $stmt = $conexao->prepare("INSERT INTO Loja (nome_loja, id_pessoa, id_itens, tipo_loja) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $nome_loja, $id_pessoa, $id_itens, $tipo_loja);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        $retorno = [
            'status' => 'ok', 
            'mensagem' => 'Loja criada com sucesso!'
        ];
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Falha ao criar a loja.'
        ];
    }

    $stmt->close();
    $conexao->close();

    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>
