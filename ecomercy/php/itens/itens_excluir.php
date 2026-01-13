<?php
    header("Content-type:application/json;charset:utf-8");
    include_once('../conexao.php');
    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        try {
            
            $stmt1 = $conexao->prepare("DELETE FROM Loja WHERE id_itens = ?");
            $stmt1->bind_param("i", $id);
            $stmt1->execute();
            $stmt1->close();
            
            
            $stmt = $conexao->prepare("DELETE FROM Itens WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if($stmt->affected_rows > 0){
                $retorno = [
                    'status' => 'ok', 
                    'mensagem' => 'Registro excluído com sucesso.'
                ];
            } else {
                $retorno = [
                    'status' => 'nok', 
                    'mensagem' => 'Registro não excluído (ID não encontrado).'
                ];
            }
            $stmt->close();
        } catch(Exception $e) {
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Erro ao excluir: ' . $e->getMessage()
            ];
        }
    } else {
        $retorno = [
            'status' => 'nok', 
            'mensagem' => 'É necessário informar um ID para exclusão.'
        ];
    }
    $conexao->close();

    echo json_encode($retorno);
?>
