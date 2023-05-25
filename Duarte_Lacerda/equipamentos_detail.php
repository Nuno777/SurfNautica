<?php
require('../conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamentos - SurfNautica</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/equips.css">
    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="vendor/aos/aos.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="css/navbar.css" rel="stylesheet">
</head>

<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <?php
    include_once("header.php");
    ?>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg"></div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <?php
        $id = $_GET['id'];
        if ($id == 1) {
            header("Location: equipamentos.php");
        }
        $sql = "select name, descr, pic from equips where id_equip = " . $id . "and name <> 'Pranchas';";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $res => $key) {
                    $name = $row['name'];
                    $descr = $row['descr'];
                    $pic = $row['pic'];
                }
                echo ("<div class='row mb-4'>
                        <h2 class='col-12 tm-text-primary'>" . $name . "</h2>
                        </div>
                        <div class='row tm-mb-90'>
                        <div class'col-xl-8 col-lg-7 col-md-6 col-sm-12'>
                            <img src='img/" . $pic . "' alt='Image' class='img-fluid'>
                        </div>
                        <div class='col-xl-4 col-lg-5 col-md-6 col-sm-12'>
                            <div class='tm-bg-gray tm-video-details'>
                                <p class='mb-12'>" . $descr . "</p>
                            </div>
                        </div>");
            }
        } else {
            echo ("Erro ao executar o select:" . mysqli_connect_error($conn));
        }
        ?>
    </div>
    <!-- <div class="row tm-mb-90">
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <img src="img/img-01-big.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <h3 class="tm-text-gray-dark mb-3">Titulo</h3>
                    <p class="mb-4">
                        Free for both personal and commercial use. No need to pay anything. No need to make any
                        attribution. Free for both personal and commercial use. No need to pay anything. No need to make any
                        attribution.
                    </p>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">Titulo</h3>
                        <p>Free for both personal and commercial use. No need to pay anything. No need to make any
                            attribution. Free for both personal and commercial use. No need to pay anything. No need to make any
                            attribution.
                        </p>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">Titulo</h3>
                        <p>Free for both personal and commercial use. No need to pay anything. No need to make any
                            attribution. Free for both personal and commercial use. No need to pay anything. No need to make any
                            attribution.
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
    <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">
            Mais Equipamentos
        </h2>
    </div>
    <div class="row mb-3 tm-gallery">
        <?php
        $sql = "SELECT name, pic, date_pub FROM surfnautica.equips;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $res => $key) {
                    $name = $row['name'];
                    $pic = $row['pic'];
                    $date_pub = date("d/m/Y", strtotime($row['date_pub']));
                }
                echo ('<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                            <figure class="effect-ming tm-video-item">
                                <img src="img/' . $pic . '" alt="Image" class="img-fluid">
                                <figcaption class="d-flex align-items-center justify-content-center">
                                    <h2>' . $name . '</h2>
                                    <a href="equipamentos_detail.php">Ver Mais</a>
                                </figcaption>
                            </figure>
                            <div class="d-flex justify-content-between tm-text-gray">
                                <span class="tm-text-gray-light">' . $date_pub . '</span>
                            </div>
                        </div>');
            }
        } else {
            echo ("Erro ao executar o select:" . mysqli_connect_error($conn));
        }

        mysqli_close($conn);
        ?>
    </div>
    </div>

    <?php
    include_once("footer.php");
    ?>

    <!-- Vendor JS Files -->
    <script src="vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="vendor/aos/aos.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/glightbox/js/glightbox.min.js"></script>
    <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="vendor/swiper/swiper-bundle.min.js"></script>
    <script src="vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="js/main.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>

</html>