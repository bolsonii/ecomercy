<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(isset($_GET['id'])){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria_produtos'];
        $id = $_GET['id'];

        $stmt = $conexao->prepare("UPDATE materiais SET nome = ?, preco = ?, categoria_produtos = ? WHERE id_materiais = ?");

        $stmt->bind_param("sdsi", $nome, $preco, $categoria, $id);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Material alterado com sucesso.'
            ];
        } else {
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Falha ao alterar o registro (ou nada foi modificado).'
            ];
        }
        $stmt->close();
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'Nenhum ID informado para alteração.'
        ];
    }
    
    $conexao->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>