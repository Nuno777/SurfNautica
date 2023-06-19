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
  <title>Dia Aberto</title>
  <link rel="stylesheet" href="css/diaaberto.css">
  <link href="assets/css/navbar.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="css/escolasurf.css">
</head>

<body>

<header id="header" class="fixed-top">
    <?php
    require_once 'sheets/navbar.php';
    ?>
</header>

<?php
$sql = "SELECT nome, titulo, data1, horas FROM diaaberto, professor WHERE diaaberto.id_prof = professor.id_prof ORDER BY data1 ASC;";
$result = mysqli_query($conn, $sql);

?>

<div class="container-sm ">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/05.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/Foundation-Course.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/small-groups-surfing.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</div>

<div class="container-sm">
<!-- <table class="table">
<h3>Dias abertos</h3>
<h5>Aprenda a surfar gratuitamente, nós disponibilizamos o material todo necessário, é só aparecer!</h5>
<div class="texto">
  A <strong>SurfNautica</strong> tem instrutores de surf e bodyboard que possuem as qualificações técnicas necessárias para que os alunos aprendam a surfar e a desenvolver o seu surf com a máxima segurança e qualidade.
</div>
        <thead>
          <tr class="table-info">
            <th scope="col">Dia da Semana</th>
            <th scope="col">Horários</th>
            <th scope="col">Professor</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr>
            <th scope="row">Terças</th>
            <td>10-11h & 16-17h</td>
            <td>Carlos da Silva</td>
          </tr>
          <tr>
            <th scope="row">Quintas</th>
            <td>10-11h & 16-17h</td>
            <td>Pedro Lourenço</td>
          </tr>
          <tr>
            <th scope="row">Sábados</th>
            <td scope="row">9-11h & 15-17h</td>
            <td scope="row">Tiago Esperança</td>
          </tr>
        </tbody>
      </table> -->

<?php
    if (mysqli_num_rows($result) > 0) {
    echo ("<table class='table'><h3>Dias abertos</h3>
    <h5>Aprenda a surfar gratuitamente, nós disponibilizamos o material todo necessário, é só aparecer!</h5>
    <div class='texto'>
      A <strong>SurfNautica</strong> tem instrutores de surf e bodyboard que possuem as qualificações técnicas necessárias para que os alunos aprendam a surfar e a desenvolver o seu surf com a máxima segurança e qualidade.
    </div><thead><tr class='table-info'><th>Dia da Semana</th><th>Horários</th><th>Horas</th><th>Professor</th></tr></thead><tbody class='table-group-divider'>");
    while ($row= mysqli_fetch_assoc($result)) {
        echo"<tr><td>".$row['titulo']."</td><td>".date("d/m/Y", strtotime($row['data1']))."</td><td>".$row['horas']."</td><td>".$row['nome']."</td></tr>";
    }
    echo"</tr> </tbody></table>";
} 
else {
    echo ("Erro ao executar o select:" . mysqli_connect_error($conn));
}

mysqli_close($conn);

?>
</div>

<div style="padding-top: 100px; padding-bottom: 40px;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 bg-light" style="width: 100%;">
          <img class="card-img-top" src="img/resize.jpg" alt="" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><strong>Aulas em Grupo</strong></h5>
            <p class="card-text card-wrap">
            Aulas de surf para pessoas de todas as idades e níveis de surf. 
             Cada grupo tem no máximo 5 alunos por treinador, 
              para maior diversão e segurança de todos.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card border-0 bg-light" style="width: 100%;">
          <img class="card-img-top" src="img/1.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><strong>Aulas Privadas</strong></h5>
            <p class="card-text card-wrap">Aulas individuais com um personal trainer especializado em surf. 
             Se quiseres trazer a tua cara metade e o teu melhor amigo, 
              a SurfNautica também dispõe de aulas privadas para pequenos grupos.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card border-0 bg-light" style="width: 100%;">
          <img class="card-img-top" src="img/2.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><strong>Clínicas de Surf</strong></h5>
            <p class="card-text card-wrap">Disponíveis durante as férias escolares, as clínicas de surf proporcionam momentos de diversão, contacto com a natureza e muito surf.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="background-image: url('img/banner.jpg'); background-size: cover; background-position: center center; text-align: center; padding: 20px;">
  <h3 style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Faz Login para poderes inscrever-te!</h3>
  <a href="../login.php" class="btn btn-light" style="background-color: #263f49; color: white;">Ir para o Login</a>
</div>






<footer id="footer">
  <?php
  require_once 'sheets/footer.php';
  ?>
</footer>



<script src="js/bootstrap.min.js"></script>
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