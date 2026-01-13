<?php 
$navbar_logout_link = '../home/logout.php';
include('../../php/navbar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <link rel="stylesheet" href="coleta.css" />>
    <link rel="stylesheet" href="../lojas/lojas.css" />
    <style>
        .coleta-card.user-loja-card {
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }
        .coleta-card.user-loja-card:hover {
            transform: scale(1.04);
            box-shadow: 0 7px 22px rgba(0, 0, 0, 0.42);
        }
        
        .coleta-card .form-label { color: var(--cor-brilho); }
        .coleta-card .form-control { background-color: rgba(255,255,255,0.03); color: var(--cor-brilho); border-color: var(--border-color); }
        .coleta-card .form-control:focus { box-shadow: 0 0 0 0.15rem rgba(168,255,120,0.12); }
    </style>
</head>
<body>
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="user-loja-card card-loja coleta-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="card-titulo mb-0">Criação de Ponto de Coleta</h2>
                        </div>

                        <form id="formColeta">
                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" id="endereco" name="endereco" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="hora" class="form-label">Horário</label>
                                <input type="time" id="hora" name="hora" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="loja" class="form-label">Nome da loja</label>
                                <input type="text" id="loja" name="loja" class="form-control" />
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success" id="salvarColeta">Criar Coleta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br /><br />
    <footer class="text-light mt-5 pt-4 pb-3 position-absolute top-100" id="footer-home">
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
    <script src="../../js/ponto-coleta/criarColeta.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



