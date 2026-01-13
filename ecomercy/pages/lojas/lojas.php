<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojas - Ecomercy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="lojas.css">
    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
</head>
<body>

    <div class="container mt-4">
        <h1 class="main-header">Lojas EcoMercy</h1>

        <!-- Botão para criar nova loja -->
        <div class="mb-4">
            <a href="criarLoja.php" class="btn btn-success btn-lg">
                <i class="fas fa-plus-circle"></i> Criar Nova Loja
            </a>
        </div>

        <hr>

        <!-- Seção Minhas Lojas -->
        <section id="sua-loja-section" class="mb-5">
            <h2 class="section-title">Minha(s) Loja(s)</h2>
            <div id="container-loja-usuario" class="row">
                <!-- As lojas do usuário serão carregadas aqui via JavaScript -->
            </div>
        </section>

        <!-- Seção Outras Lojas -->
        <section id="outras-lojas-section">
            <h2 class="section-title">Outras Lojas</h2>
            <div id="container-outras-lojas" class="row g-4">
                <!-- As outras lojas serão carregadas aqui via JavaScript -->
            </div>
        </section>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../../js/lojas/lojas.js"></script>
</body>
</html>



