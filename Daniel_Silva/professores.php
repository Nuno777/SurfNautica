<!DOCTYPE html>
<html>
<head>
    <?php
  require_once 'sheets/head.php';
  ?>
    <title>Tabela de Professores de Surf</title>
    <link rel="stylesheet" type="text/css" href="styles_prof.css">
 
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


    </section>
    <h1>Tabela de Professores</h1>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Foto</th>
            <th>Especialidade</th>
        </tr>
    
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

              // Consulta ao banco de dados para obter os professores
              $sql = "SELECT nome, email, foto, especialidade FROM professor";
              $result = mysqli_query($conn, $sql);
  
              // Exibindo os dados na tabela
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row["nome"] . "</td>";
                      echo "<td>" . $row["email"] . "</td>";
                      echo "<td>" . $row["foto"] . "</td>";
                      echo "<td>" . $row["especialidade"] . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>Nenhum professor encontrado.</td></tr>";
              }
  
            // Fechar a conexão
            $conn->close();
        ?>
    </table>
    
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
