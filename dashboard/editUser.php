<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
if (isset($_POST["editUser"])) {
  $id = $_POST["id"];
  $email = $_POST["email"];
  $nome = $_POST["nome"];
  $query = "UPDATE users SET nome='$nome' WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  // Definir Alerta - Operações (UPDATE) 
  if ($conn->affected_rows > 0) {
    $_SESSION["message"] = array(
      "content" => "The email  <b>" . $email . "</b> permission has been updated successfully!",
      "type" => "success",
    );
  } else {
    $_SESSION["message"] = array(
      "content" => "There was an error updating email permissions <b>" . $email . "</b>!",
      "type" => "danger",
    );
  }
  header('Location: dashboard.php');
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard | Editar Cliente</title>
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
        $id = $_GET["id"];
        $query = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if ($result && $result->num_rows) {
          $row = $result->fetch_object();
          $id = $row->id;
          $email = $row->email;
          $nome = $row->nome;
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
                    <h4 class="header-title">Editar Cliente</h4>
                    <br>
                    <div class="single-table">

                      <form id="editUser" action="editUser.php" method="POST" class="form" enctype="multipart/form-data">
                        <div class="row">

                          <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" required hidden>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="fname">Nome</label>
                              <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" value="<?= $nome ?>" >
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="lname">Email</label>
                              <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?= $email ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                            </div>
                          </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="editUser" id="editbutton" disabled>Editar</button>

                        <a href="dashboard.php" class="btn btn-secondary" name="voltarcontato" type="submit">Voltar</a>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        } else {
          echo "<script>alert('Seleciona um cliente valido!');window.location='listAdmin.php'</script>";
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
          $('#editUser').on('input change', function() {
            $('#editbutton').attr('disabled', false);
          });
        })
      </script>

</body>

</html>