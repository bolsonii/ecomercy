<?php
   include_once('../conexao.php');
    
    $retorno = [ 
        'status'    => '',
        'mensagem'  => '',
        'data'      => []
    ];
    
    $titulo    = $_POST['titulo']; 
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];

    $stmt = $conexao->prepare("INSERT INTO tutorial(titulo, descricao, categoria_tutorial) VALUES(?,?,?)");
    $stmt->bind_param("sss", $titulo, $descricao, $categoria);
    $stmt->execute();
    
    if($stmt->affected_rows > 0){ 
        $retorno = [ 
            'status' => 'ok',
            'mensagem' => 'Registro inserido com sucesso.',
            'data' => []
        ];
    }else{
        $retorno = [ 
            'status' => 'nok',
            'mensagem' => 'Falha ao inserir o registro.',
            'data' => []
        ];
    }
    $stmt->close();
    $conexao->close();
    header("Content-type:application/json;charset:utf-8");
    echo json_encode($retorno);
?>