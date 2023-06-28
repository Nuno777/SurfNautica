<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/news.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/navbar.css" rel="stylesheet">
  <link href="assets/img/favicon.ico" rel="icon">
  <title>Noticias</title>
</head>

<body>
  <header id="header" class="fixed-top ">
    <?php
    require_once 'header.php';
    ?>
  </header>

  <main id="main">
    <div class="container">



      <div class="title1 mb-3">
        <h2>Noticias</h2>
      </div>

      <!-- carrosel -->

      <div id="carouselExampleCaptions" class="carousel slide mb-5">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/img/surf.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>1 noticia</h5>
              <p>################</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/img/surf.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>2 noticia</h5>
              <p>>################</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/img/surf.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>3 noticia</h5>
              <p>>################</p>
              </p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>



      <!-- caixas de noticias -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/teresa.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Surf: Teresa Bonvalot garante qualificação olímpica</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://maisfutebol.iol.pt/modalidades/surf/surf-teresa-bonvalot-garante-qualificacao-olimpica"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/teresa.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Surf: Teresa Bonvalot garante qualificação olímpica</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://maisfutebol.iol.pt/modalidades/surf/surf-teresa-bonvalot-garante-qualificacao-olimpica"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/teresa.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Surf: Teresa Bonvalot garante qualificação olímpica</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://maisfutebol.iol.pt/modalidades/surf/surf-teresa-bonvalot-garante-qualificacao-olimpica"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/pedro.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Morreu Pedro Martins de Lima, o 'pai' do surf em Portugal</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://www.noticiasaominuto.com/desporto/2213526/morreu-pedro-martins-de-lima-o-pai-do-surf-em-portugal"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/pedro.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Morreu Pedro Martins de Lima, o 'pai' do surf em Portugal</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://www.noticiasaominuto.com/desporto/2213526/morreu-pedro-martins-de-lima-o-pai-do-surf-em-portugal"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>

        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/pedro.jpg" alt="">
            <div class="card-body">
              <p class="card-text">Morreu Pedro Martins de Lima, o 'pai' do surf em Portugal</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="https://www.noticiasaominuto.com/desporto/2213526/morreu-pedro-martins-de-lima-o-pai-do-surf-em-portugal"><button type="button" class="btn btn-sm btn-outline-secondary border-0">Ver</button></a>

                </div>
                <small class="text-body-secondary"></small>
              </div>
            </div>
          </div>
        </div>

      </div>


      <!-- video -->
      <h2 class="title1 mb-3 mt-5">Videos</h2>
      <div class="box mx-auto mt-5 mb-4">

        <div class="video-list">
          <video class="active" src="assets/img/vid1.mp4" muted></video>
          <video src="assets/img/vid2.mp4" muted></video>
          <video src="assets/img/vid3.mp4" muted></video>
          <video src="assets/img/vid4.mp4" muted></video>
          <video src="assets/img/vid5.mp4" muted></video>

        </div>


        <div class="main-video">
          <video src="assets/img/vid1.mp4" muted controls autoplay></video>



        </div>

      </div>
    </div>

  </main>







  <?php
  include_once("footer.php");
  ?>


  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/news.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
</body>

</html>