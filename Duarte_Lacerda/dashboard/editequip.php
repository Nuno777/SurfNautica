<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';

$id_parceria = $_GET['id_parceria'];
$id_equipa = $_GET['id_equipa'];

$sql = "SELECT * FROM equipamentos WHERE id_equipa = " . $id_equipa . ";";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  foreach ($row as $res => $key) {
    $nome = $row['nome'];
    $desc = $row['descricao'];
    $img = $row['img'];
    $data_pub = $row['data_pub'];
  }
}
$partner = isset($_POST['inputpartner']) == '' ? "" :  $_POST['inputpartner'];
$nome = isset($_POST['inputname']) == '' ? "" : $_POST['inputname'];
$img = isset($_POST['inputImg']) == '' ? "" : $_POST['inputImg'];
$desc = isset($_POST['inputdesc']) == '' ? "" : $_POST['inputdesc'];
$msg_erro = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validar variáveis
  if ($nome == "" || $partner == "" || $img == "" || $desc == "") {
    $msg_erro = "Nome, descrição e imagem não inseridos ou parceria não escolhida!";
  } else {
    /* estabelecer ligação à BD */
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à Base de Dados ($code $message)!";
    } else {
      /* executar query... */
      $query = "UPDATE equipamentos SET nome = " . $nome . ", descricao = " . $desc . ", img = " . $img . ", id_parceria = " . $partner . " WHERE id_equipa = " . $id_equipa . ");";

      $sucesso_query = $conn->query($query);
      if ($sucesso_query) {
        if ($conn->affected_rows > 0) {
          $_SESSION["message"] = array(
            "content" => "O equipamento <b>" .  $nome . "</b> foi editar com sucesso!",
            "type" => "success",
          );
        } else {
          $_SESSION["message"] = array(
            "content" => "Ocorreu um erro ao editar o equipamento <b>" . $nome . "</b>!",
            "type" => "danger",
          );
        }
        header("Location: showequip.php");
        exit(0);
      } else {
        $code = $conn->errno; // error code of the most recent operation
        $message = $conn->error; // error message of the most recent op.
        $msg_erro = "Falha na query! ($code $message)";
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Equipamento</title>
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
                  <h4 class="header-title">Editar Equipamento</h4>
                  <br>
                  <form action="editequip.php" method="POST">
                    <div class="form-group">
                      <label for="inputname">Nome</label>
                      <input type="text" class="form-control" name="inputname" id="inputname" value="<?php echo ($nome); ?>" required>
                      <small id="name">
                        Por favor preencha o campo
                      </small>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputdesc">Descrição</label>
                        <textarea type="text" class="form-control" name="inputdesc" id="inputdesc" rows="12" style="resize: vertical;" require><?php echo ($desc); ?></textarea>
                        <small id="desc">
                          Por favor preencha o campo
                        </small>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputpartner">Parceria</label>
                        <select name="inputpartner" id="inputpartner" class="form-control">
                          <?php
                          $sql = "SELECT * FROM parcerias WHERE id_parceria = " . $id_parceria . ";";
                          $resultParceria = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultParceria)) {
                            foreach ($row as $res => $key) {
                              $p = $row['nome'];
                            }
                            echo "<option selected>$p</option>";
                          }
                          $sql = "SELECT * FROM parcerias where nome <> '$p';";
                          $resultP = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($resultP)) {
                            foreach ($row as $res => $key) {
                              $id = $row['id_parceria'];
                              $parceria = $row['nome'];
                            }
                            echo "<option value='$id'>$parceria</option>";
                          }
                          ?>
                        </select>
                        <small id="partner">
                          Por favor preencha o campo
                        </small>
                        <br>
                        <label for="">Imagem</label>
                        <div class="custom-file form-group">
                          <input type="file" name="inputImg" class="custom-file-input" accept="image/*" id="inputImg">
                          <label class="custom-file-label" for="inputImg"><?php echo $img; ?></label>
                          <small id="img">
                            Por favor preencha o campo
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <input type="submit" class="btn btn-primary" id="submitbtn" value="Confirmar" style="margin-right: 5px;">
                      <a href="showequip.php"><input type="button" value="Voltar" class="btn btn-primary"></a>
                    </div>
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
          $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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