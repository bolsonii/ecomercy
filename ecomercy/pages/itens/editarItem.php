<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Itens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
</head>
<body>
    <?php 
      $navbar_home_link = '#inicio';
      $navbar_logout_link = 'logout.php';
      include('../../php/navbar.php');
    ?>
    <br /><br />
                    
    <div class="container mt-5 pt-3 flex-grow-1">
        <h1>Editar Item</h1>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" readonly style="background-color: #e9ecef;">
        </div>
        
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        
        <div class="mb-3">
            <label for="preco" class="form-label">Preço (R$)</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>
        
        <div>
            <button type="button" class="btn btn-success" id="enviar">
                <i class="bi bi-check-circle"></i> Salvar Alterações
            </button>
            <a href="gerenciarItens.php" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>
    </div>
    
    <footer class="bg-dark text-light mt-5 pt-4 pb-3">
        <div class="container-fluid">
        <div class="row">

            <div class="col-md-6 mb-3">
            <h5 class="text-success">Ecomercy</h5>
            <p>
                A <strong>Ecomercy</strong> é uma empresa dedicada a conectar pessoas interessadas 
                na compra e venda de lixo eletrônico, promovendo sustentabilidade e reaproveitamento 
                tecnológico. Fundada por cinco empreendedores apaixonados por inovação e meio ambiente.
            </p>
            </div>

            <div class="col-md-3 mb-3">
            <h6 class="text-success">Links úteis</h6>
            <ul class="list-unstyled">
                <li><a href="#" class="text-light text-decoration-none">Sobre</a></li>
                <li><a href="#" class="text-light text-decoration-none">Tutoriais</a></li>
                <li><a href="#" class="text-light text-decoration-none">Loja</a></li>
                <li><a href="#" class="text-light text-decoration-none">Pontos de coleta</a></li>
            </ul>
            </div>

            <div class="col-md-3 mb-3">
            <h6 class="text-success">Contato</h6>
            <p class="mb-1"><i class="bi bi-envelope"></i> contato@ecomercy.com</p>
            <p class="mb-1"><i class="bi bi-telephone"></i> (41) 99999-9999</p>
            <div>
                <a href="#" class="text-success me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-success me-3"><i class="bi bi-github"></i></a>
                <a href="#" class="text-success"><i class="bi bi-linkedin"></i></a>
            </div>
            </div>
        </div>

        <hr class="border-secondary" />

            <p class="text-center text-secondary mb-0">
            &copy; 2025 <span class="text-success">Ecomercy</span> – Todos os direitos reservados.
            </p>
        </div>
    </footer>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../../js/itens/editarItens.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>



