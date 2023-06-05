<?php
require_once 'conexao.php';
$email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
$nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : "";
$assunto = array_key_exists('assunto', $_POST) ? $_POST['assunto'] : "";
$mensagem = array_key_exists('mensagem', $_POST) ? $_POST['mensagem'] : "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($email == "" || $nome == "" || $assunto == "" || $mensagem == "")
    $msg_erro = "Campos não preenchidos";
  else {
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à BaseDados ($code $message)!";
    } else {

      $email = $conn->real_escape_string($email);
      $nome = $conn->real_escape_string($nome);
      $assunto = $conn->real_escape_string($assunto);
      $mensagem = $conn->real_escape_string($mensagem);

      $query = "INSERT INTO `contacto` (`email`, `nome`, `assunto`, `mensagem`) VALUES ('$email', '$nome', '$assunto', '$mensagem')";

      $sucesso_query = $conn->query($query);
      if ($sucesso_query) {
        header("Location: contacto.php");
        exit(0);
      } else {
        $code = $conn->errno;
        $message = $conn->error;
        $msg_erro = "Falha na query! ($code $message)";
      }
    }
  }
}
?>
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
              <p>+351 262 777 111</p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-6 ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3014.977444350692!2d-9.368743958631846!3d39.35025750943084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1f48a9de96c075%3A0x59825346bd0e936a!2sPraia%20do%20Molhe%20Leste!5e1!3m2!1spt-PT!2spt!4v1679914429168!5m2!1spt-PT!2spt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="col-lg-6">
            <form id="contacto" action="contacto.php" method="POST" role="form" class="php-email-form" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" maxlength="30" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Assunto" maxlength="60" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="mensagem" id="mensagem" rows="10" placeholder="Mensagem" style="resize: none" required></textarea>
              </div>
              <br>
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
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery-3.4.1.min.js"></script>

</body>

</html>