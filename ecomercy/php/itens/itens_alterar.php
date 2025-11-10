<?php
    include_once('conexao.php');

    $retorno = [
        'status'   => '',
        'mensagem' => '',
        'data'     => []
    ];

    if(isset($_GET['id'])){
        
        //Simulando as informações que vem do front
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        //Preparando para inserção no banco de dados
        $stmt = $conexao->prepare("UPDATE Itens SET nome = ?, preco = ?
        WHERE id = ?");
        $stmt->bind_param("sdi", $nome, $preco, $_GET['id']);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $retorno = [
                'status'   => 'ok',
                'mensagem' => 'Registro alterado com sucesso.',
                'data'     => []
        ];
        }
    }else{
        $retorno = [
            'status'   => 'nok',
            'mensagem' => 'Não posso alterar um registro sem um ID informado.',
            'data'     => []
        ];
    }
    $stmt->close();
    $conexao->close();

    header('Content-type:application/json;charset:utf-8');
    echo json_encode($retorno);
?>