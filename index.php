<?php
require_once 'conexao.php';
$query = "SELECT nome, titulo, data1, horas FROM diaaberto, professor WHERE diaaberto.id_prof = professor.id_prof ORDER BY data1 DESC;";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once 'sheets/head.php';
  ?>
  <title>SurfNautica</title>
</head>

<body>

  <header id="header" class="fixed-top header-transparent">
    <?php
    require_once 'sheets/navbar.php';
    ?>
  </header>

  <section id="hero">
    <div class="hero-container">
      <h1>Surf Em Peniche</h1>
      <h2>A vida é melhor quando fazes surf</h2>
      <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevron-down"></i></a>
    </div>
  </section>

  <main id="main">

    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-up">
            <div class="content">
              <h3>Nossa Escola de Surf</h3>
              <p> Vem já melhorar ou praticar o teu surf nos dias de melhores ondas que o mar litoral tem para oferecer</p>
              <a href="Tiago_Gomes/escolasurf.php" class="about-btn">Ver Mais</a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class='bx bx-home-alt-2'></i>
                  <h4>Professores</h4>
                  <p>Na nossa escola de surf temos vários professores qualificados na área do surf</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Parcerias</h4>
                  <p>Pode ver algumas parcerias que vão ajudar na nossa escola de surf </p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <img src="assets/img/board.png" alt="">
                  <br><br>
                  <h4>Pranchas</h4>
                  <p>Pode ver vários tipos de pranchas que são patrocinados pelas nossas parcerias</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-shield"></i>
                  <h4>Equipamentos</h4>
                  <p>Temos vários equipamentos de surf que são patrocinados pelas nossas parcerias</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Nossos Serviços</h2>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class='bx bxs-lock-open-alt'></i></div>
              <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Dias Abertos</a></h4>
              <p class="description">Se quiser aprender a surfar tem aulas de surf no dia aberto totalmente grátis </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class='bx bxs-group'></i></div>
              <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Aulas em Grupo</a></h4>
              <p class="description">Se quiser aprender mais um pouco tem aulas de grupo com um professor de surf</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class='bx bxs-user'></i></div>
              <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Aulas Privadas</a></h4>
              <p class="description">Se quiseres ter mais privacidade e aprender mais tem aulas privadas com um personal trainer</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class='bx bxs-clinic'></i></div>
              <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Clínicas de Surf</a></h4>
              <p class="description">Se quiser passar umas semanas só com a natureza pode visitar a nossa clínica nas ferias </p>
            </div>
          </div>

        </div>
      </div>
    </section>


    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">
        <div class="section-title text-center">
          <h2>Dias Abertos</h2>
          <p>Quer aprender a surfar? Para você temos aulas de dias abertos gratuitamente, basta fazer a inscrição.</p>
          <p>Para ver mais informações sobre os dias abertos, clique no <a href="Tiago_Gomes/diaaberto.php" class="cta-a"><b>ver mais</b></a>.</p>
          <a class="cta-btn" href="Tiago_Gomes/diaaberto.php">Ver Mais</a>
        </div>
      </div>
    </section>

    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Aulas de Dias Abertos</h2>
        </div>
        <div class="row">
          <?php
          $counter = 0;

          while ($row = $result->fetch_object()) {
            if ($counter >= 4) {
              break; 
            }
          ?>
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class='bx bxs-lock-open-alt'></i></div>
                <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Dia Aberto</a></h4>
                <p class="description">Aula com o(a) professor(a) <?php echo $row->nome?> na <?php echo $row->titulo?> às <?php echo $row->horas?></p>
                <small class="description"><?php echo  $row->data1;?></small>
              </div>
            </div>
          <?php
            $counter++;
          }

          if ($counter == 0) {
          ?>
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up">
                <div class="icon"><i class='bx bxs-lock-open-alt'></i></div>
                <h4 class="title"><a href="Tiago_Gomes/diaaberto.php">Dias Abertos</a></h4>
                <p class="description">Não temos nenhum dia aberto disponível neste momento </p>
              </div>
            </div>
          <?php
          }
          ?>



        </div>
      </div>
    </section>

  </main>

  <footer id="footer">
    <?php
    require_once 'sheets/footer.php';
    ?>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script>
    $(window).on("load", function() {
      $('body').addClass('loaded');
    });
  </script>
</body>

</html>