<?php
require('../conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pranchas - SurfNautica</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/equips.css">
    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">

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
    <!-- <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->

    <?php
    include_once("header.php");
    ?>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg"></div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <?php
        $id_prancha = $_GET['id_prancha'];

        $sql = "select nome, descricao, img from pranchas where id_prancha = '$id_prancha';";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $res => $key) {
                    $nome = $row['nome'];
                    $desc = $row['descricao'];
                    $img = $row['img'];
                }
                echo ("<div class='row mb-4'>
                        <h2 class='col-12 tm-text-primary'>" . $nome . "</h2>
                       </div>
                        <div class='row tm-mb-90'>
                            <div class='col-xl-8 col-lg-7 col-md-6 col-sm-12'>
                                <img src='dashboard/upload/" . $img . "' alt='Image' class='img-fluid'>
                            </div>
                            <div class='col-xl-4 col-lg-5 col-md-6 col-sm-12'>
                                <div class='tm-bg-gray tm-video-details'>
                                    <p class='mb-12'>" . $desc . "</p>
                                </div>
                            </div>
                        </div>");
            }
        } else {
            echo ("Erro ao executar o select:" . mysqli_connect_error($conn));
        }
        ?>
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Mais pranchas
            </h2>
        </div>
        <div class="row mb-3 tm-gallery">
            <?php
            $sql = "select * from pranchas order by id_prancha;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $res => $key) {
                        $id_prancha = $row['id_prancha'];
                        $nome = $row['nome'];
                        $img = $row['img'];
                        $data_pub = date("d/m/Y", strtotime($row['data_pub']));
                    }
                    echo ('<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                            <figure class="effect-ming tm-video-item">
                                <img src="dashboard/upload/' . $img . '" alt="Image" style="width: 500px; height: 275px" class="img-fluid">
                                <figcaption class="d-flex align-items-center justify-content-center">
                                    <h2>' . $nome . '</h2>
                                    <a href="pranchas_detail.php?id_prancha=' . $id_prancha . '">Ver Mais</a>
                                </figcaption>
                            </figure>
                            <div class="d-flex justify-content-between tm-text-gray">
                                <span class="tm-text-gray-light">' . $data_pub . '</span>
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