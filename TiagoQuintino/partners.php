<!doctype html>
<html lang="en">
<?php
require('database.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/partners.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/navbar.css" rel="stylesheet">
    <link href="assets/img/favicon.ico" rel="icon">
    <title>Parcerias</title>
</head>
<title>Parcerias</title>
</head>

<body>

    <header id="header" class="fixed-top ">
        <?php
        require_once 'header.php';
        ?>
    </header>
    <div class="container marketing">
        <div class="row mt-md-5">
            <?php
            $sql = "select nome, img, descricao from parcerias;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $res => $key) {
                        $name = $row['nome'];
                        $pic = $row['img'];
                        $descri = $row['descricao'];
                    }
                    echo ("  <div class='col-lg-4'>
                <img class='bd-placeholder-img rounded-circle object-fit-contain border rounded' src='assets/img/" . $pic . "' alt='Image' width='140' height='140'> </img>
                <h2>" . $name . "</h2>
                <p>" . $descri . "</p>
            </div>");
                }
            } else {
                echo ("Erro ao executar o select:" . mysqli_connect_error($connection));
            }

            mysqli_close($connection);
            ?>

        </div>
        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <!-- Nova Parceira com IPL em que os estudantes tem desconto de 10% a 15% + imagem do IPL  -->
                <h2 class="featurette-heading">Novo Parceiro. <span class="text-muted">Instituto Politecnico de Leiria(IPL).</span></h2>
                <p class="lead">O IPL oferece uma ampla gama de cursos nas áreas de ciências, tecnologia, artes, saúde, educação, negócios e turismo.
                    Os estudantes Poderão participar de aulas e ter um desconto.</p>
                <p><a class="btn btn-secondary" href="https://www.ipleiria.pt/">Visitar &raquo;</a></p>
            </div>
            <div class="col-md-5">
                <img src="assets/img/ipl.png" class="featurette-image img-fluid mx-auto" width="500" height="500"></img>

            </div>
        </div>


        <hr class="featurette-divider">
    </div>

    <?php
    include_once("footer.php");
    ?>

    <script src="assets/js/jquery-3.6.3.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
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