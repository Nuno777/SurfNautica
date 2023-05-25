<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
  <link href="img/favicon.png" rel="icon">
  <link href="img/favicon.png" rel="apple-touch-icon">

  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <link href="vendor/aos/aos.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="js/main.js"></script>
  <script src="js/bootstrap.js"></script>
  
    <title>Pranchas</title>
</head>

<body class="">




    <!-- header -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
          <div class="logo">
    
            <h1 class="text-light"><a href="../index.html"><img src="img/favicon.png" alt=""
                  class="img-fluid"><span>SurfNautica</span></h1></a>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li class="dropdown"><a href="#" class="nav-link scrollto"><span>Sobre</span>
                  <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="#">História do Clube</a></li>
                  <li><a href="#">Parcerias</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="nav-link scrollto"><span>Escola
                    de Surf</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="#">Dias Abertos</a></li>
                  <li><a href="#">Aulas</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" class="nav-link scrollto"><span>Info
                    Surf</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="#">Pranchas</a></li>
                  <li><a href="#">Equipamentos</a></li>
                </ul>
              </li>
              <li><a class="nav-link scrollto" href="#">Noticias</a></li>
              <li><a class="nav-link scrollto" href="contacto.html">Contactos</a></li>
              <li><a class="nav-link scrollto" href="#">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav>
    
        </div>
      </header>




    <!-- aaaa -->

    <main>

    



        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="img/pexels-clayton-de-araujo-15202715.jpg" class="d-block w-100" alt="####">
                </div>
                <div class="carousel-item">
                    <img src="img/pexels-harold-granados-14188978.jpg" class="d-block w-100" alt="####">
                </div>
                <div class="carousel-item">
                    <img src="img/pexels-clayton-de-araujo-15202715.jpg" class="d-block w-100" alt="####">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



        <?php
  $serverName="localhost";
  $userName="root";
  $password="";
  $baseDados="surfnautica";
  
  //fazer a ligação 
$conn=mysqli_connect($serverName,$userName,$password,$baseDados);
  
  // Verificar se a conexão foi estabelecida corretamente
  if(!$conn){
    die("Erro de ligação:".mysqli_connect_error());
}


  
  // Buscar cenas a base
  $query = "SELECT id_prancha, nome, descricao, id_parceria FROM pranchas";
  $result = mysqli_query($conn, $query);
  
  // Verificar
  if (!$result) {
      die("Erro de ligação: " . mysqli_error($conn));
  }
  ?>
<!-- tabela de pranchas -->

<h1 class="text-center pt-5 mt-5 mb-5 pb-5">Dados das Pranchas</h1>

    <table class="tabela-pranchas">
        <tr>
            <th>ID Pranchas</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>ID Patrocinadores</th>
        </tr>
        <?php
        // Dados que vão ser exibidos
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_prancha'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['id_parceria'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>



        

        <!-- 1111 -->




        <h1 class="text-center pt-5 mt-5 mb-5 pb-5">Tipos de Pranchas</h1>
        <hr class="featurette-divider">

        <div class="row featurette ">
            <div class="col-md-7 p-5">
                <h2 class="featurette-heading fw-normal lh-1">Stand Paddle Board </h2>
                <p class="lead pt-3">É a maior prancha de surf. O seu tamanho, largura e espessura permitem suportar com
                    estabilidade o peso de uma pessoa de pé em qualquer circunstância, seja sobre a onda ou seja fora
                    dela. Nesta enorme prancha, o surfista leva um remo flexível para se impulsionar e também para
                    manobrar na onda. A Stand Paddle Board é uma excelente e divertida opção para os dias de surf com as
                    ondas pequenas e com pouca força. </p>
            </div>
            <div class="col-md-5">
                <div class="container">
                    <img src="img/prancha1.jpg" class="img-thumbnail" alt="Cinque Terre" width="500" height="500">
                </div>

            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2 p-0">
                <h2 class="featurette-heading fw-normal lh-1">Longboard </h2>
                <p class="lead pt-3">É uma prancha de surf grande e de ponta redonda também conhecida como “prancha grossa”.
                    Inspirada nos troncos havaianos, são as primeiras pranchas de surf, as que se usaram no início da
                    expansão do surf. A Longboard é ideal para ondas pequenas e médias. Também pode ser usada para ondas
                    grandes, mas apenas se o surfista tiver experiencia. Este tipo de prancha tem movimentos próprios
                    como o Hang Five, o Hang Ten e o Drop Knee. </p>
            </div>
            <div class="col-md-5 order-md-1">
                <div class="container">
                    <img src="img/prancha2.jpg" class="img-thumbnail" alt="Cinque Terre" width="500" height="500">
                </div>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 p-5">
                <h2 class="featurette-heading fw-normal lh-1">Gun</h2>
                <p class="lead pt-3">Este tipo de prancha de surf, com ponta e cauda afiadas, o seu design afiado e longo faz
                    com que acelerem muito e que sejam muito estáveis, o que as faz perfeitas para surfar grandes ondas.
                    A Gun é uma prancha adequada para surfistas experientes</p>
            </div>
            <div class="col-md-5 ">
                <div class="container mx-auto">
                    <img src="img/prancha3.jpg" class="img-thumbnail" alt="Cinque Terre" width="500" height="500">
                </div>
            </div>
        </div>

        <hr class="featurette-divider">

        <!--  -->










        <!-- footer -->
        <footer id="footer">
            <div class="footer-top">
              <div class="container">
                <div class="row">
                  <div class="col-lg-2 col-md-6">
                  </div>
                  <div class="col-lg-3 col-md-6 footer-links">
        
                    <a href="index.html"><img src="img/favicon.png" alt="" height="100px"></a>
        
                    <div class="social-links mt-3">
                      <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                      <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                      <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                      <a href="mailto:" target="_blank" class="google-plus"><i class="bx bx-envelope"></i></a>
                    </div>
        
                  </div>
                  <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Informações</h4>
                    <ul>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Dias Abertos</a></li>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Aulas</a></li>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Notícias</a></li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Outros Links</h4>
                    <ul>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre</a></li>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Parcerias</a></li>
                      <li><i class="bx bx-chevron-right"></i> <a href="#">Contacto</a></li>
                    </ul>
                  </div>
                  <div class="credits">
                    &copy; Copyright <strong><span>SURFNAUTICA</span></strong>. All
                    Rights
                    Reserved
                  </div>
                  <!-- 
                      <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Informações</h4>
                        <ul>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Dias Abertos</a></li>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Aulas</a></li>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Notícias</a></li>
                        </ul>
                      </div>
          
                      <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Web
                              Development</a></li>
                          <li><i class="bx bx-chevron-right"></i> <a href="#">Product
                              Management</a></li>
                        </ul>
                      </div>
                      <div class="credits">
                        &copy; Copyright <strong><span>SURFNAUTICA</span></strong>. All
                        Rights
                        Reserved
                      </div> -->
                </div>
              </div>
            </div>
        
          </footer>
        </div>
</body>

</html>


<?php
// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>