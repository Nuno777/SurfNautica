<?php
require('database.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>

<?php
require_once 'sheets/head.php';
?>

  <title>Professores</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/professores.css">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
</head>


<body>
<header id="header" class="fixed-top">
    <?php
    require_once 'sheets/navbar.php';
    ?>
</header>

<div class="container-sm">
        <img src="assets/img/22.jpg" class="d-block w-100 object-fit-cover">
</div>


<div class="container-sm">
  <div class="row mt-md-5">
    <?php
    $sql = "SELECT nome, email, foto, especialidade FROM professor";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $res => $key) {
                $nome = $row['nome'];
                $foto = $row['foto'];
                $email = $row['email'];
                $especialidade = $row['especialidade'];
            }
            ?>
            <div class="col-lg-4">
              <div class="card border-0">
                <img class="card-card-img-overlay rounded-circle" src="assets/img/<?php echo $foto; ?>" alt="Image" width="300" height="300" style="object-fit: cover;">
                <div class="card-body">
                  <h4 class="card-title text-center"><?php echo $nome; ?></h4>
                  <p class="card-text"><strong>Email:</strong> <?php echo $email; ?></p>
                  <p class="card-text"><strong>Especialidade:</strong> <?php echo $especialidade; ?></p>
                </div>
              </div>
            </div>
            <?php
        }
    } else {
        echo "Erro ao executar o select: " . mysqli_connect_error($conn);
    }

    mysqli_close($conn);
    ?>
  </div>
</div>


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
  <script src="assets/js/main.js"></script>
  <script src="assets/js/jquery-3.4.1.min.js"></script>
</body>
</html>
