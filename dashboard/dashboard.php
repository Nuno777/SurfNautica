<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}
require_once '../conexao.php';
$query = "SELECT permission from users where email = '{$_SESSION['email']}'";
$perms = mysqli_query($conn, $query);
$levelperm = mysqli_fetch_assoc($perms);
if ($levelperm['permission'] == 0) {
  header('Location: ../dashboard/user_profile.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard</title>
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
        <div class="content">
          <!-- Alerta - Operações (LOGIN) -->
          <?php
          if (isset($_SESSION["message"])) { ?>
            <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
              <?php echo $_SESSION["message"]["content"]; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
            </div>

          <?php unset($_SESSION["message"]);
          }
          ?>
          <!-- Top -->
          <div class="row">
            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Criar Professor</h2>
                  <div class="sub-title">
                    <a href=""><span class="mr-1">Criar novo Professor</span></a>
                  </div>
                </div>
                <?php
                  $query = "SELECT id FROM users WHERE permission='1' ORDER BY id";
                  $totalprof = mysqli_query($conn, $query);
                  $prof = mysqli_num_rows($totalprof);
                  ?>
                <div class="card-body">
                  <p>Total de Professores: <?php echo $prof?> </p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Criar Aulas</h2>
                  <div class="sub-title">
                    <a href="listPerms.php"><span class="mr-1">Criar Nova Aula</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $query = "SELECT id_aula FROM aulas ORDER BY id_aula";
                  $totalaulas = mysqli_query($conn, $query);
                  $aulas = mysqli_num_rows($totalaulas);
                  ?>
                  <p>Total de Aulas: <?php echo $aulas?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Criar Parcerias</h2>
                  <div class="sub-title">
                    <a href="listProf.php"><span class="mr-1">Criar Nova Parceria</span></a>
                  </div>
                </div>
                <div class="card-body">
                <?php
                  $query = "SELECT id_parceria FROM parcerias ORDER BY id_parceria";
                  $totalparc= mysqli_query($conn, $query);
                  $parcerias = mysqli_num_rows($totalparc);
                  ?>
                  <p>Total de Parcerias: <?php echo $parcerias?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Criar Notícias</h2>
                  <div class="sub-title">
                    <a href="listUser.php"><span class="mr-1">Criar Nova Notícia</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $query = "SELECT id_not FROM noticia ORDER BY id_not";
                  $totalnot = mysqli_query($conn, $query);
                  $noticia = mysqli_num_rows($totalnot);
                  ?>
                  <p>Total de Notícias: <?php echo $noticia?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Top -->
          <!-- Table -->
          <div class="card">
            <div class="card-body">
              <?php
              $query = "SELECT id FROM users WHERE permission=0 ORDER BY id";
              $totaluser = mysqli_query($conn, $query);
              $user = mysqli_num_rows($totaluser);
              ?>
              <h4 class="header-title">Clientes<p>Total de Clientes: <?php echo $user ?></p>
              </h4>
              <br>
              <div class="single-table">
                <div class="table-responsive">
                  <table class="table text-center">
                    <thead class="text-uppercase bg-dark">
                      <tr class="text-white">

                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT nome,email,permission, CASE WHEN permission = 2 THEN 'Administrador' WHEN permission = 1 THEN 'Professor'  WHEN permission = 0 THEN 'Usuário' ELSE permission END AS permission FROM users";
                      $result = mysqli_query($conn, $query);
                      $resultdelete = mysqli_query($conn, $query);
                      while ($row = $result->fetch_object()) {
                      ?>
                        <tr>
                          <td><?php echo $row->nome ?></td>
                          <td><?php echo $row->email ?></td>
                          <td><?php echo $row->permission ?></td>
                          <td><a href='editUser.php?id=<?php echo $row->id ?>' class='text-warning' name='edit'> <i class="mdi mdi-pencil"></i></a></td>
                          <td><a data-toggle='modal' data-target='#deleteUser<?php echo $row->id ?>' class='text-danger' name='delete'> <i class="mdi mdi-delete"></i></a></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal para eliminar -->
          <?php while ($row = $resultdelete->fetch_object()) { ?>
            <div class="modal fade" id='deleteUser<?php echo $row->id ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar o Cliente</h5><span class="span-contat"><?php echo $row->email; ?></span>
                  </div>
                  <div class="modal-body">
                    <p>Deseja eliminar este Cliente?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <a href='deleteUser.php?id=<?php echo $row->id . '&email=' . $row->email ?>' type='button' class='btn btn-primary'>Sim</a>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
          <!-- Modal para eliminar fechou -->

        </div>

        <!-- End Table -->
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