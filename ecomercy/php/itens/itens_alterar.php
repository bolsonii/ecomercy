<?php
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(isset($_GET['id'])){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $id = $_GET['id'];

        $stmt = $conexao->prepare("UPDATE Itens SET nome = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("sdi", $nome, $preco, $id);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $retorno = [
                'status' => 'ok', 
                'mensagem' => 'Item alterado com sucesso.'
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
