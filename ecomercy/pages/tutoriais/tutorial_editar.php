<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <title>Editar Tutorial</title>
</head>
<body>
    <div class="container mt-4">

    <div class="container mt-4">
        <h1>Editar Tutorial</h1>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" readonly style="background-color: #e9ecef;">
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecione...</option>
                <option value="Limpeza e armazenamento">Limpeza e armazenamento</option>
                <option value="Triagem e classificação">Triagem e classificação</option>
                <option value="Reparos básicos para revenda">Reparos básicos para revenda</option>
                <option value="Segurança de dados">Segurança de dados</option>
            </select>
        </div>
        <div>
            <button type="button" id="enviar" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Salvar Alterações
            </button>
            <a href="tutoriais.php" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>
        <div id="resultado" class="mt-3 text-danger fw-bold"></div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../../js/tutoriais/tutorial_editar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



