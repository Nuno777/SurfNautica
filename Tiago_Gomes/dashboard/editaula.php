<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';

$id_diaAberto = $_GET['id_diaAberto'];
$id_prof = $_GET['id_prof'];

$sql = "select id_diaAberto, titulo, titulo, data1, horas, id_prof from diaAberto";
$result = mysqli_query($conn, $sql);
$resultAulas = mysqli_query($conn, $sql);
$resultdelete = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  foreach ($row as $res => $key) {
    $id_diaAberto = $row['id_diaAberto'];
    $titulo = $row['titulo'];
    $data1 = $row['data1'];
    $horas = $row['horas'];
    $id_prof = $row['id_prof'];
  }
}

/* if (!isset($_POST)) {
  $titulo = trim($_POST['titulo']);
  $data1 = trim($_POST['data1']);
  $partner = mysqli_query($conn, "SELECT id_diaAberto FROM diaaberto WHERE titulo LIKE " . $_POST['inputpartner'] . ";");;
  $img = trim($_POST['inputImg']);
}

if (isset($_POST)) {
  $sql = "INSERT INTO equipamentos (titulo, data1, img, id_diaAberto) VALUES ('$titulo', '$data1', '$img', '$partner');";
  mysqli_query($conn, $sql);
} */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Aula</title>
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
          <a href="../../index.php">
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
        <!-- Top -->
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
                  <h4 class="header-title">Editar Aulas</h4>
                  <br>
                  <form action="showaula.php" method="POST">
                    <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo ($titulo); ?>" required>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="data1">Data</label>
                        <textarea type="text" class="form-control" name="data1" id="data1" rows="12" style="resize: vertical;" require><?php echo ($data1); ?></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputpartner">Parceria</label>
                        <select name="partner" id="inputpartner" class="form-control">
                          <?php
                          $sql = "SELECT * FROM diaaberto WHERE id_diaAberto = " . $id_diaAberto . ";";
                          $resultAulas = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultAulas)) {
                            foreach ($row as $res => $key) {
                              $p = $row['horas'];
                            }
                            echo "<option selected>$p</option>";
                          }
                          $sql = "SELECT * FROM diaaberto where horas <> '$p';";
                          $resultAulas = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultAulas)) {
                            foreach ($row as $res => $key) {
                              $horas = $row['horas'];
                            }
                            echo "<option>$horas</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                    <a href="showeaula.php"><input type="button" value="Voltar" class="btn btn-primary"></a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Top -->
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

</body>

</html>