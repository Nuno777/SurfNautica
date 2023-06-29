<?php
require('conexao.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  require_once 'sheets/head.php';
  ?>

  <title>SurfNautica</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escola de Surf</title>
  <link rel="stylesheet" href="css/escoladesurf.css">

</head>

<body>

  <header id="header" class="fixed-top">
    <?php
    require_once 'sheets/navbar.php';
    ?>
  </header>

  <body>
    <div class="container-sm">
      <div class="container-fluid">
        <div class="embed-responsive embed-responsive-16by9">
          <div class="padding" style="padding-top: 150px;">
            <iframe class="embed-responsive-item" width="1280" height="720" src="https://www.youtube.com/embed/Qgix7zo3HUg" title="Video Promocional SurfNautica" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>

    <div class="container-sm">
      <div class="card1 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="row g-0 align-items-center">
            <div class="col-md-4">
              <img src="img/61d87b936a5c4c6b6b2ba1e6_IMG_0018 (2).jpg" class="img-fluid">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h4 class="card-title">Bem-vindos à escola de Surf</h4>
                <p class="card-text">Somos a primeira escola de Surf em Peninche com a opção de escolha de dias abertos no verão. <br>
                  Vem já melhorar ou praticar o teu surf nos dias de melhores ondas que o mar litoral tem para oferecer. <br>
                  <br>
                  Aproveita o nosso plano de aulas abertas e vê se gostarias de passar um belíssimo verão connosco.
                </p>
                <p class="card-text"><small class="text-body-secondary">SurfNautica</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card1 d-flex justify-content-center">
        <div class="card mb-3 border-0">
          <div class="row g-0 align-items-center">
            <div class="col-md-8">
              <div class="card-body">
                <h4 class="card-title">O nosso website está a crescer</h4>
                <p class="card-text">A SurfNautica já conta com algumas parcerias de grande nome.<br>
                  Mais de 10 professores já estão ligados ao SurfNautica. Junta-te a nós!<br>
                </p>
                <p class="card-text"><small class="text-body-secondary">SurfNautica</small></p>
              </div>
            </div>
            <div class="col-md-4">
              <img src="img/homens-e-meninas-estao-surfando.jpg" class="img-fluid object-fit-cover">
            </div>
          </div>
        </div>
      </div>

    </div>
    <footer id="footer">
      <?php
      require_once 'sheets/footer.php';
      ?>
    </footer>


  </body>

  <script src="js/bootstrap.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

</html>