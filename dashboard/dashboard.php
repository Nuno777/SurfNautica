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
  header('Location: ../index.php');
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
                  <h2>New Admin</h2>
                  <div class="sub-title">
                    <a href="newAdmin.php"><span class="mr-1">Create new Admin</span></a>
                  </div>
                </div>
                <div class="card-body">

                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Update Permission</h2>
                  <div class="sub-title">
                    <a href="listPerms.php"><span class="mr-1">Change the permission</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $query = "SELECT id FROM users ORDER BY id";
                  $total = mysqli_query($conn, $query);
                  $total = mysqli_num_rows($total);
                  ?>
                  <p>Total Accounts: <?php echo $total ?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>List Admins</h2>
                  <div class="sub-title">
                    <a href="listAdmin.php"><span class="mr-1">List Admins with Permission</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $query = "SELECT id FROM users WHERE permission=1 ORDER BY id";
                  $totaladm = mysqli_query($conn, $query);
                  $adm = mysqli_num_rows($totaladm);
                  ?>
                  <p>Total Admins: <?php echo $adm ?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>List Users</h2>
                  <div class="sub-title">
                    <a href="listUser.php"><span class="mr-1">Simply list users</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <?php
                  $query = "SELECT id FROM users WHERE permission=0 ORDER BY id";
                  $totaluser = mysqli_query($conn, $query);
                  $user = mysqli_num_rows($totaluser);
                  ?>
                  <p>Total Simple Users: <?php echo $user ?></p>
                  <div class="chart-wrapper">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Top -->
          <!-- Table -->
          <div class="row">
            <div class="col-xl-12">
              <table class="table text-center">
                <thead class="text-uppercase thead-dark">
                  <tr>
                    <th scope="col">Permission</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM users ORDER BY id AND permission DESC";
                  $result = mysqli_query($conn, $query);
                  while ($row = $result->fetch_object()) {
                  ?>
                    <tr>
                      <td><?php echo $row->permission ?></td>
                      <td><?php echo $row->nome ?></td>
                      <td><?php echo $row->email ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <br>
        <!-- End Table -->

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