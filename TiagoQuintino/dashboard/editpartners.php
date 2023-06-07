<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';

$id_parceriabuscar = $_GET['id_parceria'];

$sql = "SELECT * FROM parcerias WHERE id_parceria = " . $id_parceriabuscar . ";";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  foreach ($row as $res => $key) {
    $id_parceria = $row['id_parceria'];
    $nomeParceria = $row['nome'];
    $desc = $row['descricao'];
    $img = $row['img'];
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validar variáveis
  $id = isset($_POST['idParceiroHidden']) ? $_POST['idParceiroHidden'] : "";
  $name = isset($_POST['name']) ? $_POST['name'] : "";
  $img = $_FILES['inputImg']['name'];
  $tmp_name = $_FILES['inputImg']['tmp_name'];
  $target_file = basename($_FILES["inputImg"]["name"]);
  $folder = "../assets/img/" . $img_name;
  move_uploaded_file($tmp_name, $folder);

  $desc = isset($_POST['inputdesc']) ? $_POST['inputdesc'] : "";
  if ($nome == "" || $img == "" || $desc == "") {
    echo $nome . " " . $target_file . " " . $desc;

    $msg_erro = "Nome, descrição e imagem não inseridos ou não escolhida!";
  } else {
    echo "sdasdasdasda";
    /* estabelecer ligação à BD */
    require_once '../../conexao.php';
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à Base de Dados ($code $message)!";
    } else {
      /* executar query... */
      $query = "UPDATE parcerias SET nome = '" . $name . "', descricao = '" . $desc . "', img = '" . $img . "' WHERE id_parceria = " . $id . ";";
      echo $query;
      print_r($_POST);
      $sucesso_query = mysqli_query($conn, $query);
      if ($sucesso_query) {
        if ($conn->affected_rows > 0) {
          $_SESSION["message"] = array(
            "content" => "O parceiro <b>" .  $name . "</b> foi criado com sucesso!",
            "type" => "success",
          );
        } else {
          $_SESSION["message"] = array(
            "content" => "Ocorreu um erro ao criar o parceiro <b>" . $name . "</b>!",
            "type" => "danger",
          );
        }
        header("Location: showpartners.php");
        exit(0);
      } else {
        $code = $conn->errno; // error code of the most recent operation
        $message = $conn->error; // error message of the most recent op.
        $msg_erro = "Falha na query! ($code $message)";
      }
    }
  }
}

/*  */

print_r($_POST);



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Dashboard - Parceria</title>
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
                  <h4 class="header-title">Editar Parceria</h4>
                  <br>
                  <form enctype="multipart/form-data" action="showpartners.php" method="POST">
                    <input type="hidden" id="idParceiroHidden" name="idParceiroHidden" value="<?php echo $id_parceriabuscar; ?>">
                    <div class="form-group">
                      <label for="name">Nome</label>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $nomeParceria; ?>" required>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputdesc">Descrição</label>
                        <textarea type="text" class="form-control" name="inputdesc" id="inputdesc" rows="12" style="resize: vertical;" required><?php echo ($desc); ?></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputImg">Imagem</label>
                        <div class="custom-file form-group">
                          <div class="preview">
                            <img id="file-ip-1-preview">
                          </div>
                          <input type="file" name="inputImg" class="custom-file-input" id="inputImg">
                          <label class="custom-file-label" for="inputImg" value="<?php echo ($img); ?>"><?php echo ($img); ?></label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                    <a href="showpartners.php"><input type="button" value="Voltar" class="btn btn-primary"></a>
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
      <script src="assets/js/validation.js"></script>

</body>

</html>