<?php include('../../php/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Materiais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css">
    <link rel="stylesheet" href="../../GlobalStyles/GlobalStyles.css">
    <link rel="stylesheet" href="../ponto-coleta/coleta.css">
</head>
<body>
    <main>
        <div class="text-center">
            <p class="paragrafo-top">Crie um novo material!</p>
            <button type="button" class="btn btn-outline-success" id="criarMaterial" ><i class="fa-solid fa-plus"></i></button>
        </div>
        <div class="text-center" id="retorno">
          
        </div>
    </main>
    <br /><br />
    <footer class="text-light mt-5 pt-4 pb-3" id="footer-home">
        <div class="container-fluid">
            <hr class="border-secondary" />
            <p class="text-center text-secondary mb-0">
            &copy; 2025 <span class="text-success">Ecomercy</span> — Todos os direitos reservados.
            </p>
        </div>
    </footer>
    <script src="../../js/materiais/materiais.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>



