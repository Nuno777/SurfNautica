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
  header('Location: /Permission_level/dashboard/profile.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Lista de Users</title>
  <?php
  require_once 'sheets/dashboardHead.php';
  ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <script>
    NProgress.configure({
      showSpinner: false
    });
    NProgress.start();
  </script>

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
          <!-- Alerta - Operações (DELETE) -->
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
          <div class="card">
            <div class="card-body">
              <h4 class="header-title">Lita de Users</h4>
              <br>
              <br>

              <div class="single-table">
                <div class="table-responsive">
                  <table class="table text-center">
                    <thead class="text-uppercase bg-dark">
                      <tr class="text-white">

                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM users WHERE permission=0 ORDER BY id";
                      $result = mysqli_query($conn, $query);
                      $resultdelete = mysqli_query($conn, $query);
                      while ($row = $result->fetch_object()) {
                      ?>
                        <tr>
                          <td><?php echo $row->nome ?></td>
                          <td><?php echo $row->email ?></td>
                          <!-- <td><a href='editUser.php?id=<?php echo $row->id ?>' class='text-primary' name='edit'> <i class="mdi mdi-square-edit-outline"></i></a></td> -->
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
          <!-- End Top -->

          <!-- Modal para eliminar -->
          <?php while ($row = $resultdelete->fetch_object()) { ?>
            <div class="modal fade" id='deleteUser<?php echo $row->id ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar User</h5><span class="span-contat"><?php echo $row->email; ?></span>
                  </div>
                  <div class="modal-body">
                    <p>Deseja eliminar este User?</p>
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