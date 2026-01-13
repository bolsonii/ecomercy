<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <title>Gerenciar itens</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <div class="container mt-5 pt-3 flex-grow-1">
    <h1>Gerenciar itens</h1>
    <div class="mb-3">
      <button id="novo" type="button" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Novo
      </button>
    </div>

    <div>
        <div id="lista">
          </div>
    </div>
  </div>
    
    <footer class="bg-dark text-light mt-auto pt-4 pb-3">
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
            &copy; 2025 <span class="text-success">Ecomercy</span> — Todos os direitos reservados.
            </p>
        </div>
    </footer>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../../js/itens/Itens.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>



