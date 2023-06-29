<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
$query = "SELECT * FROM contacto ORDER BY id_cont DESC";
$result = mysqli_query($conn, $query);
$resultMenssage = mysqli_query($conn, $query);
$resultRespond = mysqli_query($conn, $query);
$resultdelete = mysqli_query($conn, $query);

//perms
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
  <title>Dashboard | Contactos</title>
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
                  <h4 class="header-title">Mensagens</h4>
                  <br>
                  <div class="single-table">
                    <div class="table-responsive table-hover">
                      <table class="table text-center ">
                        <thead class="text-uppercase bg-dark">
                          <tr class="text-white">

                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Assunto <br><small>*clica para ver a mensagem</small></th>
                            <th scope="col">Data da Mensagem</th>
                            <th scope="col">Resposta<br><small>*clica para ver a resposta</small></th>
                            <th scope="col">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($row = $result->fetch_object()) {
                            echo "<tr>";
                            echo "<td>" . $row->nome . "</td>";
                            echo "<td>" . $row->email . "</td>";
                            echo "<td><a data-toggle='modal' data-target='#viewmensagem$row->id_cont' class='text-primary' name='Menssage'><span class='txtcontact text-primary'><i class='mdi mdi-comment-text-outline'></i> " . substr("$row->assunto", 0, 25) . "...</span></a></td>";
                            echo "<td>" . $row->data_pub . "</td>";
                            echo "<td><a data-toggle='modal' data-target='#viewrespond$row->id_cont' class='text-primary' name='resposta'><span class='txtcontact text-primary' ><i class='mdi mdi-comment-text-outline'></i> " . substr("$row->resposta", 0, 25) . "...</span></a></td>";
                            echo "<td><a data-toggle='modal' data-target='#deletecontato$row->id_cont' class='text-danger' name='delete'><i class='mdi mdi-trash-can-outline'></i></a></td>";
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

        <!-- Modal de ver mensagem -->
        <?php while ($row = $resultMenssage->fetch_object()) {
          $mensagem = $row->mensagem;
          $assunto = $row->assunto;
          $data = $row->data_pub;
        ?>
          <div class="modal fade" id='viewmensagem<?php echo $row->id_cont ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Mensagem de <b><?php echo $row->nome; ?></b></h5><span class="span-contat"><?php echo $row->email; ?><br><small><?php echo $row->data_pub;?></small></span>
                </div>
                <!-- assunto -->
                <div class="modal-body">
                  <span>Assunto</span>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea type="text" class="form-control" rows="3" style="resize: none" disabled><?= $assunto ?></textarea>
                    </div>
                  </div>
                </div>

                <!-- mensagem -->
                <div class="modal-body">
                  <span>Mensagem</span>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea type="text" class="form-control" rows="10" style="resize: none" disabled><?= $mensagem ?></textarea>
                    </div>
                  </div>
                </div>
                
                <div class="modal-footer">
                  <?php echo "<a href='respondcontacto.php?id_cont=$row->id_cont' type='button' class='btn btn-primary'>Responder</a>"; ?>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <!-- Modal de ver mensagem fechou -->

        <!-- Modal de ver resposta -->
        <?php while ($row = $resultRespond->fetch_object()) {
          $resposta = $row->resposta;

        ?>
          <div class="modal fade" id='viewrespond<?php echo $row->id_cont ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Resposta ao <b><?php echo $row->nome; ?></b></h5><span class="span-contat"><?php echo $row->email; ?><br><small><?php echo $row->data_pub;?></small></span>
                </div>

                <!-- mensagem -->
                <div class="modal-body">
                  <span>Resposta</span>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea type="text" class="form-control" rows="10" style="resize: none" disabled><?= $resposta ?></textarea>
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
        <!-- Modal de ver resposta fechou -->

        <!-- Modal para eliminar -->
        <?php while ($row = $resultdelete->fetch_object()) { ?>
          <div class="modal fade" id='deletecontato<?php echo $row->id_cont ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar Mensagem</h5><span class="span-contat"><?php echo $row->email; ?></span>
                </div>
                <div class="modal-body">
                  <p>Deseja eliminar esta mensagem?</p>
                </div>
                <div class="modal-footer">
                  <a href='deletecontato.php?id_cont=<?php echo $row->id_cont . '&email=' . $row->email ?>' type='button' class='btn btn-primary'>Sim</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
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