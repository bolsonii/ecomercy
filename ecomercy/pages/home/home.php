<?php include('../../php/navbar.php'); ?>
<?php
  include_once('../../php/valida_sessao.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <title>Document</title>
    <link rel="stylesheet" href="../../style/globalStyles.css" />
    <link rel="stylesheet" href="../../GlobalStyles/NavBar.css" />
    <link rel="stylesheet" href="home.css" />
  </head>
  <body>
    <?php 
      $navbar_home_link = '#inicio';
      $navbar_logout_link = 'logout.php';
      include('../../php/navbar.php');
    ?>
    <br /><br />

    <!-- Carrossel empresas parceiras -->
    <section id="inicio" class="parceiros-section">
      <div class="container">
        <h2>Empresas Parceiras</h2>
        <div
          id="carouselParceiros"
          class="carousel carousel-parceiros slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="d-flex justify-content-around">
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/correio.webp"
                    alt="Logo Correios"/>
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/adidas.png"
                    alt="Logo Empresa B"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/apple.webp"
                    alt="Logo Empresa C"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/havaianas.png"
                    alt="Logo Empresa D"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/kfc.webp"
                    alt="Logo Empresa E"
                  />
                </div>
              </div>
            </div>

            <div class="carousel-item">
              <div class="d-flex justify-content-around">
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/lacoste.png"
                    alt="Logo Empresa F"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/pepsi.png"
                    alt="Logo Empresa G"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/Starbucks-Logo.png"
                    alt="Logo Empresa H"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/Vilebrequin-logo.png"
                    alt="Logo Empresa I"
                  />
                </div>
                <div class="logo-parceiro">
                  <img
                    src="../../assets/empresas/lv-logo.png"
                    alt="Logo Empresa J"
                  />
                </div>
              </div>
            </div>
          </div>

          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselParceiros"
            data-bs-slide="prev"
          >
            <i class="bi bi-chevron-left carousel-control-prev-icon"></i>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselParceiros"
            data-bs-slide="next"
          >
            <i class="bi bi-chevron-right carousel-control-next-icon"></i>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      </div>
    </section>

    <!-- Começo Sobre nós -->
    <section id="sobre" class="sobre-nos">
      <div class="container">
        <h2 class="text-center mb-4">Sobre Nós</h2>
        <div class="row align-items-center">
          <div class="col-md-6">
            <p>
              A <strong>Ecomercy</strong> é uma empresa dedicada a conectar
              pessoas interessadas na compra e venda de lixo eletrônico,
              promovendo sustentabilidade e reaproveitamento tecnológico.
              Fundada por cinco empreendedores apaixonados por inovação e meio
              ambiente. <br><br>
              Nossa missão é facilitar o processo de troca de equipamentos
              eletrônicos usados, garantindo que esses itens sejam reutilizados
              ou reciclados de maneira adequada, reduzindo o impacto ambiental.
            </p>
          </div>
          <div class="col-md-6 text-center">
            <img
              src="../../assets/lixos.jpeg"
              alt="Sobre Nós"
              class="img-fluid rounded"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Footer: -->
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
                  >Tutoriais</a
                >
              </li>
              <li>
                <a href="#" class="text-light text-decoration-none">Loja</a>
              </li>
              <li>
                <a href="#" class="text-light text-decoration-none"
                  >Pontos de coleta</a
                >
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
              <a href="#" class="text-success me-3"
                ><i class="bi bi-instagram"></i
              ></a>
              <a href="#" class="text-success me-3"
                ><i class="bi bi-github"></i
              ></a>
              <a href="#" class="text-success"
                ><i class="bi bi-linkedin"></i
              ></a>
            </div>
          </div>
        </div>

        <hr class="border-secondary" />

        <p class="text-center text-secondary mb-0">
          &copy; 2025 <span class="text-success">Ecomercy</span> — Todos os
          direitos reservados.
        </p>
      </div>
    </footer>

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>




