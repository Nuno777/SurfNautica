<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require_once 'sheets/head.php';
  ?>
  <title>Contactos</title>
</head>

<body>

  <header id="header" class="fixed-top ">
    <?php
    require_once 'sheets/navbar.php';
    ?>
  </header>

  <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contactos</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Contactos</li>
          </ol>
        </div>

      </div>
    </section>


    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Endereço</h3>
              <p>Rua da Praia do Molho Leste, Peniche, 2520-206</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>surfnautica@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Telefone</h3>
              <p>+351 910 777 161</p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-6 ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3014.977444350692!2d-9.368743958631846!3d39.35025750943084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1f48a9de96c075%3A0x59825346bd0e936a!2sPraia%20do%20Molhe%20Leste!5e1!3m2!1spt-PT!2spt!4v1679914429168!5m2!1spt-PT!2spt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="col-lg-6">
            <form action="contacto.html" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nome" maxlength="30" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="assunto" placeholder="Assunto" maxlength="60" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="mensagem" rows="8" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">

              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
  </main>

  <footer id="footer">
    <?php
    require_once 'sheets/footer.php';
    ?>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center
      justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>