<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';
$query = "SELECT * FROM noticia ORDER BY id_not";
$result = mysqli_query($conn, $query);
$resultEquip = mysqli_query($conn, $query);
$resultdelete = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Notícias</title>
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
                  <h4 class="header-title">Notícias<a href="createnews.php" style="margin-left: 25px;"><button type="button" class="btn btn-primary btn-sm">Criar notícia</button></a></h4>

                  <br>
                  <div class="single-table">
                    <div class="table-responsive">
                      <table class="table table-responsive-lg text-center">
                        <thead class="text-uppercase bg-dark">
                          <tr class="text-white">

                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data</th>
                            <th scope="col">Foto</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($row as $res => $key) {
                              $id_not = $row['id_not'];
                              $titulo = $row['titulo'];
                              $desc = $row['descricao'];
                              $img = $row['foto'];
                              $data_not = $row['data_not'];
                            }
                            echo "<tr>";
                            echo "<td>" . $titulo . "</td>";
                            echo "<td>" . substr("$desc", 0, 75) . " (...)</td>";
                            echo "<td>" . $img . "</td>";
                            echo "<td>" . $data_not . "</td>";
                            echo "<td><a href='editnews.php?id_not=$id_not' class='text-warning' name='edit'><i class='mdi mdi-pencil'></i></a></td>";
                            echo "<td><a href='deletenews.php?id_not=$id_not&titulo=$titulo' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
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
        <?php while ($row = $row = mysqli_fetch_assoc($resultEquip)) {
          foreach ($row as $res => $key) {
            $id_not = $row['id_not'];
            $titulo = $row['titulo'];
            $desc = $row['descricao'];
            $img = $row['foto'];
            $data_not = $row['data_not'];
          }
        ?>
          <div class="modal fade" id='viewequip<?php echo $id_not ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Titulo</h5>
                  <span class="span-nome"><?php echo $nome; ?></span>
                </div>

                <div class="modal-body">
                  <span>Foto</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-img"><?php echo $img; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <span>Data de Publicação</span>
                  <div class="row">
                    <div class="col-md-12">
                      <span class="span-desc"><?php echo $data_not; ?></span>
                    </div>
                  </div>
                </div>

                <div class="modal-body">
                  <span>Descrição</span>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea type="text" class="form-control" rows="10" style="resize: none" disabled><?= $desc ?></textarea>
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
            $id_not = $row['id_not'];
            $titulo = $row['titulo'];
          }
        ?>
          <div class="modal fade" id='deleteequip<?php echo $id_not ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar notícia</h5><span class="span-equip"><?php echo $titulo; ?></span>
                </div>
                <div class="modal-body">
                  <p>Deseja eliminar esta notícia?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                  <a href='deletenews.php?id_cont=<?php echo $id_not . '&titulo=' . $titulo ?>' type='button' class='btn btn-primary'>Sim</a>
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