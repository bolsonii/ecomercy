<?php
?>
<nav class="navbar navbar-expand-lg bg-verde">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="<?php echo isset($navbar_home_link) ? $navbar_home_link : '../home/home.php'; ?>">🌱 Ecomercy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($navbar_sobre_link) ? $navbar_sobre_link : '../home/home.php#sobre'; ?>">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($navbar_tutoriais_link) ? $navbar_tutoriais_link : '../tutoriais/tutoriais.php'; ?>">Tutoriais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($navbar_lojas_link) ? $navbar_lojas_link : '../lojas/lojas.php'; ?>">Lojas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($navbar_coleta_link) ? $navbar_coleta_link : '../ponto-coleta/coleta.php'; ?>">Pontos de Coleta</a>
        </li>
      </ul>

      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ⚙️ Gerenciar
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="<?php echo isset($navbar_itens_link) ? $navbar_itens_link : '../itens/gerenciarItens.php'; ?>">📦 Itens</a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo isset($navbar_materiais_link) ? $navbar_materiais_link : '../materiais/material.php'; ?>">🔧 Materiais</a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo isset($navbar_pontos_link) ? $navbar_pontos_link : '../ponto-coleta/coleta.php'; ?>">📍 Ponto de Coleta</a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo isset($navbar_tutoriais_gerenciar_link) ? $navbar_tutoriais_gerenciar_link : '../tutoriais/tutoriais.php'; ?>">📚 Tutoriais</a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo isset($navbar_lojas_gerenciar_link) ? $navbar_lojas_gerenciar_link : '../lojas/lojas.php'; ?>">🏪 Loja</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-light ms-2" href="<?php echo isset($navbar_logout_link) ? $navbar_logout_link : '../home/logout.php'; ?>">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

