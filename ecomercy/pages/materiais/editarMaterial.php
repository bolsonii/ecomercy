<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <link rel="stylesheet" href="../ponto-coleta/coleta.css">
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
                            <h2 class="card-titulo mb-0">Alterar Material</h2>
                        </div>

                        <form id="formEditarMaterial">
                            <input type="hidden" id="idMaterial">

                            <div class="mb-3">
                                <label for="novoNome" class="form-label">Nome do Material</label>
                                <input type="text" id="novoNome" name="nome" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="novoPreco" class="form-label">Preço (R$)</label>
                                <input type="number" step="0.01" id="novoPreco" name="preco" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="novoCategoria" class="form-label">Categoria</label>
                                <input type="text" id="novoCategoria" name="categoria_produtos" class="form-control" />
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" id="editarMaterial" class="btn btn-success">Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <br /><br />
    <footer class="text-light mt-5 pt-4 pb-3" id="footer-home">
       </footer>
    <script src="../../js/materiais/editarMateriais.js"></script>
</body>
</html>



