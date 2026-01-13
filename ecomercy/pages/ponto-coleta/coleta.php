<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <link rel="stylesheet" href="../../GlobalStyles/GlobalStyles.css">
    <link rel="stylesheet" href="coleta.css">
</head>
<body>
    <main>
        <div class="text-center">
            <p class="paragrafo-top">Crie um ponto de coleta!</p>
            <button type="button" class="btn btn-outline-success" id="criarColeta" ><i class="fa-solid fa-plus"></i></button>
        </div>
        <div class="text-center" id="retorno">
          
        </div>
    </main>
    <br /><br />
    <footer class="text-light mt-5 pt-4 pb-3" id="footer-home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="text-success">Ecomercy</h5>
                    <p>
                    A <strong>Ecomercy</strong> é uma empresa dedicada a conectar
                    pessoas interessadas na compra e venda de lixo eletrônico,
                    promovendo sustentabilidade e reaproveitamento tecnológico.
                    Fundada por cinco empreendedores apaixonados por inovação e meio
                    ambiente.
                    </p>
                </div>

                <div class="col-md-3 mb-3">
                    <h6 class="text-success">Links úteis</h6>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#" class="text-light text-decoration-none">Sobre</a>
                        </li>
                        <li>
                            <a href="#" class="text-light text-decoration-none"
                            >Tutoriais</a>
                        </li>
                        <li>
                            <a href="#" class="text-light text-decoration-none">Loja</a>
                        </li>
                        <li>
                            <a href="#" class="text-light text-decoration-none">Pontos de coleta</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3">
                    <h6 class="text-success">Contato</h6>
                    <p class="mb-1">
                        <i class="bi bi-envelope"></i> contato@ecomercy.com
                    </p>
                    <p class="mb-1"><i class="bi bi-telephone"></i> (41) 99999-9999</p>
                    <div>
                        <a href="#" class="text-success me-3">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-success me-3">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="#" class="text-success">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary" />

            <p class="text-center text-secondary mb-0">
            &copy; 2025 <span class="text-success">Ecomercy</span> — Todos os direitos reservados.
            </p>
        </div>
    </footer>
    <script src="../../js/ponto-coleta/coleta.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>



