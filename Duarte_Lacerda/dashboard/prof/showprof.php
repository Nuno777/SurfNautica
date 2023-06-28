<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../../login.php');
  exit(0);
}

require_once '../../../conexao.php';
$query = "SELECT * FROM professor ORDER BY id_prof";
$result = mysqli_query($conn, $query);
$resultprof = mysqli_query($conn, $query);
$resultdelete = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Professores</title>
  <?php
  require_once '../sheets/dashboardHead.php';
  ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <div class="wrapper">
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="../../../index.php">
            <img src="../assets/images/favicon.png" style="height: 65px;" alt="Mono">
            <span class="brand-name text-light">SURFNAUTICA</span>
          </a>
        </div>
        <?php
        require_once '../sheets/dashboardmenu_prachas.php';
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
            require_once '../sheets/dashboardNavbar.php';
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
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-window-close"></span>
                  </button>
                </div>
              <?php unset($_SESSION["message"]);
              }
              ?>

              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <h4 class="header-title">Professores<a href="createprof.php" style="margin-left: 25px; margin-right: 25px;"><button type="button" class="btn btn-primary btn-sm">Criar professor</button></a></h4>
                    <form class="form-inline" method="POST" action="showprof.php">
                      <input type="search" name="inputsearch" class="form-control" placeholder="Nome..." aria-label="Search" aria-describedby="search-addon" />
                      <button class="btn btn-primary" name="btnsearch" type="submit"><span class="mdi mdi-magnify"></span></button>
                    </form>
                  </div>
                  <br>
                  <div class="single-table">
                    <div class="table-responsive">
                      <table class="table table-responsive-lg text-center">
                        <thead class="text-uppercase bg-dark">
                          <tr class="text-white">
                            <th scope="col">Nome</th>
                            <th scope="col">Email<br>
                              <small>*clica para ver a msg</small>
                            </th>
                            <th scope="col">Especialidade</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $search = '';
                          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $search = $_POST['inputsearch'];
                            $sql = "SELECT professor.id_prof, professor.nome, professor.email, professor.especialidade, users.id FROM professor LEFT JOIN users ON professor.id = users.id WHERE professor.nome LIKE '%$search%';";
                            if (isset($_POST['btnsearch']) && $_POST['inputsearch'] != '') {
                              $sucesso_query = mysqli_query($conn, $sql);
                              if ($sucesso_query->num_rows != 0) {
                                while ($row = mysqli_fetch_assoc($sucesso_query)) {
                                  foreach ($row as $res => $key) {
                                    $id_prof = $row['id_prof'];
                                    $nome = $row['nome'];
                                    $email = $row['email'];
                                    $especialidade = $row['especialidade'];
                                    $id_user = $row['id'];
                                  }
                                  echo "<tr>";
                                  echo "<td>" . $nome . "</td>";
                                  echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#viewprof$id_prof' class='text-primary' name='Menssage'>" . substr("$email", 0, 75) . "</a> </td>";
                                  echo "<td>" . $especialidade . "</td>";
                                  echo "<td><a href='editprof.php?id_prof=$id_prof&id_user=$id_user' class='text-warning' name='edit'><i class='mdi mdi-pencil'></i></a></td>";
                                  echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#deleteprof$id_prof' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
                                  echo "</tr>";
                                }
                              }
                            } else if (isset($_POST['btnsearch']) && $_POST['inputsearch'] == '') {
                              unset($_SESSION["message"]);
                              while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($row as $res => $key) {
                                  $id_prof = $row['id_prof'];
                                  $nome = $row['nome'];
                                  $email = $row['email'];
                                  $especialidade = $row['especialidade'];
                                  $id_user = $row['id'];
                                }
                                echo "<tr>";
                                echo "<td>" . $nome . "</td>";
                                echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#viewprof$id_prof' class='text-primary' name='Menssage'>" . substr("$email", 0, 75) . "</a> </td>";
                                echo "<td>" . $especialidade . "</td>";
                                echo "<td><a href='editprof.php?id_prof=$id_prof&id_user=$id_user' class='text-warning' name='edit'><i class='mdi mdi-pencil'></i></a></td>";
                                echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#deleteprof$id_prof' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
                                echo "</tr>";
                              }
                            }
                          } else {
                            unset($_SESSION["message"]);
                            while ($row = mysqli_fetch_assoc($result)) {
                              foreach ($row as $res => $key) {
                                $id_prof = $row['id_prof'];
                                $nome = $row['nome'];
                                $email = $row['email'];
                                $especialidade = $row['especialidade'];
                                $id_user = $row['id'];
                              }
                              echo "<tr>";
                              echo "<td>" . $nome . "</td>";
                              echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#viewprof$id_prof' class='text-primary' name='Menssage'>" . substr("$email", 0, 75) . "</a> </td>";
                              echo "<td>" . $especialidade . "</td>";
                              echo "<td><a href='editprof.php?id_prof=$id_prof&id_user=$id_user' class='text-warning' name='edit'><i class='mdi mdi-pencil'></i></a></td>";
                              echo "<td><a style='cursor: pointer;' data-toggle='modal' data-target='#deleteprof$id_prof' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
                              echo "</tr>";
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Top -->

        <!-- Modal de ver prancha -->
        <?php while ($row = mysqli_fetch_assoc($resultprof)) {
          foreach ($row as $res => $key) {
            $id_prof = $row['id_prof'];
            $nome = $row['nome'];
            $email = $row['email'];
            $especialidade = $row['especialidade'];
          }
        ?>
          <div class="modal fade" id='viewprof<?php echo $id_prof ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Professor</h5>
                </div>

                <div class="modal-body">
                  <span>Nome</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-name"><?php echo $nome; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <span>Email</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-name"><?php echo $email; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <span>Especialidade</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-desc"><?php echo $especialidade; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <!-- Modal de ver mensagem fechou -->

        <!-- Modal para eliminar -->
        <?php while ($row = mysqli_fetch_assoc($resultdelete)) {
          foreach ($row as $res => $key) {
            $id_prof = $row['id_prof'];
            $nome = $row['nome'];
          }
        ?>
          <div class="modal fade" id='deleteprof<?php echo $id_prof ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar professor</h5><span class="span-prancha"><?php echo $nome; ?></span>
                </div>
                <div class="modal-body">
                  <p>Deseja eliminar este professor?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                  <a href='deleteprof.php?id_prof=<?php echo $id_prof . '&nome=' . $nome ?>' type='button' class='btn btn-primary'>Sim</a>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <!-- Modal para eliminar fechou -->
        <br>
        <footer class="footer mt-auto">
          <?php
          require_once '../sheets/dashboardFooter.php';
          ?>
        </footer>

      </div>
      <script src="../assets/plugins/jquery/jquery.min.js"></script>
      <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/plugins/simplebar/simplebar.min.js"></script>
      <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
      <script src="../assets/plugins/apexcharts/apexcharts.js"></script>
      <script src="../assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script src="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
      <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
      <script src="../assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
      <script src="../assets/plugins/daterangepicker/moment.min.js"></script>
      <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
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
      <script src="../assets/plugins/toaster/toastr.min.js"></script>
      <script src="../assets/js/mono.js"></script>
      <script src="../assets/js/chart.js"></script>
      <script src="../assets/js/map.js"></script>
      <script src="../assets/js/custom.js"></script>

</body>

</html>