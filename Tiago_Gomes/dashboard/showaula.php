<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';

$sql = "select id_diaAberto, titulo, data1, horas, diaaberto.id_prof, nome from diaAberto, professor where diaaberto.id_prof=professor.id_prof;";
$result = mysqli_query($conn, $sql);
$resultAulas = mysqli_query($conn, $sql);
$resultdelete = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Aulas</title>
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
                  <h4 class="header-title">Aulas<a href="createaula.php" style="margin-left: 25px;"><button type="button" class="btn btn-primary btn-sm">Criar dia aberto</button></a></h4>

                  <br>
                  <div class="single-table">
                    <div class="table-responsive">
                      <table class="table table-responsive-lg text-center">
                        <thead class="text-uppercase bg-dark">
                          <tr class="text-white">
                            <th scope="col">Titulo</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Professor Responsável</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $res => $key) {
                              $id_diaAberto = $row['id_diaAberto'];
                              $titulo = $row['titulo'];
                              $data1 = $row['data1'];
                              $horas = $row['horas'];
                              $id_prof = $row['id_prof'];
                              $prof_nome= $row['nome'];
                            }
                            echo "<tr>";
                            echo "<td>" . $titulo . "</td>";
                            echo "<td>" . substr("$data1", 0, 75) . " (...)</td>";
                            echo "<td>" . $horas . "</td>";
                            echo "<td>" . $prof_nome . "</td>";
                            echo "<td><a href='editaula.php?id_diaAberto=$id_diaAberto&id_prof=$id_prof' class='text-warning' name='edit'><i class='mdi mdi-pencil'></i></a></td>";
                            echo "<td><a href='deleteaula.php?id_diaAberto=$id_diaAberto&titulo=$titulo' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
                            echo "</tr>";
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

        <!-- Modal de ver equipamento -->
        <?php while ($row = $row = mysqli_fetch_assoc($resultAulas)) {
          foreach ($row as $res => $key) {
            $titulo = $row['titulo'];
            $data1 = $row['data1'];
            $horas = $row['horas'];
            $id_prof = $row['id_prof'];
          }
        ?>
          <div class="modal fade" id='viewequip<?php echo $id_diaAberto ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Titulo</h5>
                  <span class="span-titulo"><?php echo $titulo; ?></span>
                </div>

                <div class="modal-body">
                  <span>Data</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-data1"><?php echo $horas; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <span>data1</span>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea type="text" class="form-control" rows="10" style="resize: none" disabled><?= $data1 ?></textarea>
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
            $id_diaAberto = $row['id_diaAberto'];
            $titulo = $row['titulo'];
            $data1 = $row['data1'];
            $horas = $row['horas'];
            $id_prof = $row['id_prof'];
          }
        ?>
          <div class="modal fade" id='deleteaula<?php echo $id_diaAberto ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar equipamento</h5><span class="span-equip"><?php echo $titulo; ?></span>
                </div>
                <div class="modal-body">
                  <p>Deseja eliminar este equipamento?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                  <a href='deleteaula.php?id_cont=<?php echo $id_diaAberto . '&titulo=' . $titulo ?>' type='button' class='btn btn-primary'>Sim</a>
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