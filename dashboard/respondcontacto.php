<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
if (isset($_POST["editcontato"])) {
  $id_cont = $_POST["id_cont"];
  $resposta = $_POST["resposta"];
  $query = "UPDATE contacto SET resposta='$resposta' WHERE id_cont='$id_cont'";
  $result = mysqli_query($conn, $query);

  // Definir Alerta - Operações (EDITAR) 
  if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
      "content" => "Respondeu a mensagem do email <b>" . $email . "</b> com sucesso!",
      "type" => "success",
    );
  } else {
    $_SESSION["message"] = array(
      "content" => "Ocorreu um erro ao responder a mensagem do email <b>" . $email . "</b>!",
      "type" => "danger",
    );
  }

  header('Location: dashboardContacto.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard | Responder</title>
  <?php
  require_once 'sheets/dashboardHead.php';
  ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <div class="wrapper">
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="../index.php">
            <img src="assets/images/favicon.png" style="height: 65px;" alt="Mono">
            <span class="brand-name text-light">SURFNAUTICA</span>
          </a>
        </div>
        <?php
        require_once 'sheets/dashboardmenu.php';
        ?>
      </div>
    </aside>

    <div class="page-wrapper">
      <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <span class="page-title">Dashboard</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>


      <div class="content-wrapper">

        <?php
        $id_cont = $_GET["id_cont"];
        $query = "SELECT * FROM contacto WHERE id_cont='$id_cont'";
        $result = mysqli_query($conn, $query);
        if ($result && $result->num_rows) {
          $row = $result->fetch_object();
          $id_cont = $row->id_cont;
          $email = $row->email;
          $nome = $row->nome;
          $assunto = $row->assunto;
          $mensagem = $row->mensagem;
          $resposta = $row->resposta;
        ?>
          <div class="content">
            <div class="row">
              <div class="col-lg-12 mt-5">

                <!-- Alerta - Operações (EDITAR) -->
                <?php
                if (isset($_SESSION["message"])) { ?>
                  <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
                    <?php echo $_SESSION["message"]["content"]; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-times"></span>
                    </button>
                  </div>

                <?php unset($_SESSION["message"]);
                }
                ?>

                <div class="card">
                  <div class="card-body">
                    <h4 class="header-title">Responder</h4>
                    <br>
                    <div class="single-table">

                      <form id="editcontato" action="respondcontacto.php" method="POST" class="form" enctype="multipart/form-data">
                        <div class="row">

                          <input type="text" class="form-control" id="id_cont" name="id_cont" value="<?= $id_cont ?>" required hidden>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="fname">Nome</label>
                              <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" value="<?= $nome ?>" disabled>
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="lname">Email</label>
                              <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?= $email ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required disabled>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="city">Assunto</label>
                              <input type="text" class="form-control" placeholder="Assunto" id="assunto" name="assunto" value="<?= $assunto ?>" disabled>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="city">Mensagem</label>
                              <textarea class="form-control" rows="10" id="mensagem" name="mensagem" minlength="4" maxlength="250" style="resize: none" disabled required><?= $mensagem ?></textarea>
                            </div>
                          </div>

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="city">Resposta</label>
                              <textarea class="form-control" rows="10" id="resposta" name="resposta" minlength="4" maxlength="250" style="resize: none" required><?= $resposta ?></textarea>
                            </div>
                          </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="editcontato" id="respondbutton" disabled>Submeter</button>

                        <a href="dashboardContacto.php" class="btn btn-secondary" name="voltarcontato" type="submit">Voltar</a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        } else {
          echo "<script>alert('Seleciona uma mensagem valida para responder');window.location='dashboardContacto.php'</script>";
        }
        ?>

        <br>
        <footer class="footer mt-auto">
          <?php
          require_once 'sheets/dashboardFooter.php';
          ?>
        </footer>



      </div>


      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/plugins/simplebar/simplebar.min.js"></script>
      <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
      <script src="assets/plugins/apexcharts/apexcharts.js"></script>
      <script src="assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
      <script src="assets/plugins/daterangepicker/moment.min.js"></script>
      <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
      <script>
        jQuery(document).ready(function() {
          jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
              cancelLabel: 'Clear'
            }
          });
          jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
          });
          jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
            jQuery(this).val('');
          });
        });
      </script>
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="assets/plugins/toaster/toastr.min.js"></script>
      <script src="assets/js/mono.js"></script>
      <script src="assets/js/chart.js"></script>
      <script src="assets/js/map.js"></script>
      <script src="assets/js/custom.js"></script>

      <!-- JQuery ativar botão editar -->
      <script>
        $(document).ready(function() {
          $('#editcontato').on('input change', function() {
            $('#respondbutton').attr('disabled', false);
          });
        })
      </script>

</body>

</html>