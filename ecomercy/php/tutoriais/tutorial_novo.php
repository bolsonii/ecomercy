<?php
   include_once('../conexao.php'); // Pegando chave de acesso ao banco de dados; 
    // Criando um molde de resposta em JSON que será enviada para o frontend; 
    $retorno = [ 
        'status'    => '',
        'mensagem'  => '',
        'data'      => []
    ];
    $titulo       = $_POST['titulo']; 
    $descricao      = $_POST['descricao'];
    $categoria    = $_POST['categoria'];

    $stmt = $conexao->prepare(" 
    INSERT INTO tutorial(titulo, descricao, categoria) VALUES(?,?,?)");
    $stmt->bind_param("sss",$titulo, $descricao, $categoria); // Informando o tipo de dado e os valores que estarão nessas variáveis;
    $stmt->execute(); // Executando a query;
    if($stmt->affected_rows > 0){ // Se a inserção funcionou (houve linhas afetadas) mensagem se sucesso; 
        $retorno = [ // A mensagem positiva que será enviada ao front
            'status' => 'ok',
            'mensagem' => 'registro inserido com sucesso',
            'data' => []
        ];
    }else{
        $retorno = [ // A mensagem negativa que será enviada ao front
            'status' => 'nok',
            'mensagem' => 'falha ao inserir o registro',
            'data' => []
        ];
    }
    $stmt->close();
    $conexao->close();
    header("Content-type:application/json; charset:utf-8"); // Indicando que o retorno será em json e com charset utf-8;
    echo json_encode($retorno);
