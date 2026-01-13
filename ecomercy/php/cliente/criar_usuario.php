<?php
    include_once('../conexao.php');

    $retorno = [
        'status' => '', 
        'mensagem' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $cpf = $_POST['cpf'] ?? '';

        if(empty($usuario) || empty($senha) || empty($nome)){
            $retorno = [
                'status' => 'nok', 
                'mensagem' => 'Usuário, senha e nome são obrigatórios.'
            ];
        } else {
            $check = $conexao->prepare("SELECT id_pessoa FROM Usuarios WHERE usuario = ?");
            $check->bind_param("s", $usuario);
            $check->execute();
            
            if($check->get_result()->num_rows > 0){
                $retorno = [
                    'status' => 'nok', 
                    'mensagem' => 'Este usuário já existe!'
                ];
            } else {
                $stmt = $conexao->prepare("INSERT INTO Usuarios (usuario, senha, nome, email, cpf) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $usuario, $senha, $nome, $email, $cpf);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    $retorno = [
                        'status' => 'ok', 
                        'mensagem' => 'Usuário criado com sucesso! Você já pode fazer login.'
                    ];
                } else {
                    $retorno = [
                        'status' => 'nok', 
                        'mensagem' => 'Erro ao criar usuário. Tente novamente.'
                    ];
                }
                $stmt->close();
            }
            $check->close();
        }
        $conexao->close();

        header("Content-type:application/json;charset:utf-8");
        echo json_encode($retorno);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Criar Usuário</title>
    <style>
        body {
            background-color: rgb(24, 41, 24);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.3);
        }
        .btn-verde {
            background-color: rgb(15, 88, 0);
            border-color: rgb(15, 88, 0);
        }
        .btn-verde:hover {
            background-color: rgb(5, 53, 9);
            border-color: rgb(5, 53, 9);
            color: white;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Criar Novo Usuário</h2>
            
            <div id="mensagem" style="display:none;"></div>

            <form id="formUsuario">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="12345678900">
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>

                <button type="submit" class="btn btn-verde w-100">Criar Usuário</button>
            </form>

            <hr>
            <p class="text-center text-muted small">
                <a href="../../pages/login.html">Já tem conta? Faça login</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('formUsuario').addEventListener('submit', async (e) => {
            e.preventDefault();

            const fd = new FormData(document.getElementById('formUsuario'));

            try {
                const resposta = await fetch('', {
                    method: 'POST',
                    body: fd
                });

                const dados = await resposta.json();
                const msgDiv = document.getElementById('mensagem');

                if(dados.status === 'ok'){
                    msgDiv.innerHTML = '<div class="alert alert-success">' + dados.mensagem + '</div>';
                    document.getElementById('formUsuario').reset();
                    setTimeout(() => {
                        window.location.href = '../../pages/login.html';
                    }, 2000);
                } else {
                    msgDiv.innerHTML = '<div class="alert alert-danger">' + dados.mensagem + '</div>';
                }
                msgDiv.style.display = 'block';
            } catch(erro) {
                alert('Erro ao criar usuário: ' + erro);
            }
        });
    </script>
</body>
</html>

