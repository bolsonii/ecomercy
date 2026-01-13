<?php
include_once('../conexao_relatorio.php'); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Controle de Acesso</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .sucesso { color: green; border: 1px solid green; padding: 10px; background-color: #e8f5e9; }
        .erro { color: red; border: 1px solid red; padding: 10px; background-color: #ffebee; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1>Relatório de Pontos de Coleta (Teste de Acesso)</h1>

    <?php
    if (!isset($conexao)) {
        die("<div class='erro'>Erro Crítico: A variável de conexão não foi encontrada. Verifique o caminho do include_once.</div>");
    }

    if ($result_user = $conexao->query("SELECT CURRENT_USER() as usuario_atual")) {
        $row_user = $result_user->fetch_assoc();
        echo "<p><strong>Conectado ao Banco como:</strong> " . $row_user['usuario_atual'] . "</p>";
    }

    $sql = "SELECT * FROM ponto_coleta";
    $result = $conexao->query($sql);

    if ($result) {
        echo "<div class='sucesso'>✅ Acesso PERMITIDO: Consulta realizada com sucesso!</div>";
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Endereço</th><th>Hora</th><th>Loja</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['hora'] . "</td>";
            echo "<td>" . $row['loja'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "<div class='erro'>❌ ERRO: " . $conexao->error . "</div>";
    }
    ?>

</body>
</html>
