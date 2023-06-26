<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../../login.php');
  exit(0);
}

require_once '../../conexao.php';
$titulo = isset($_POST['inputtitulo']) == '' ? "" :  $_POST['inputtitulo'];
$data1 = isset($_POST['inputdata1']) == '' ? "" : $_POST['inputdata1'];
$horas = isset($_POST['inputhoras']) == '' ? "" : $_POST['inputhoras'];
$id_prof = isset($_POST['inputid_prof']) == '' ? "" : $_POST['inputid_prof'];
$msg_erro = "";
print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validar variáveis
  if ($titulo == "" || $data1 == "" || $horas == "" || $id_prof == "") {
    $msg_erro = "Nome, descrição e imagem não inseridos ou parceria não escolhida!";
  } else {
    /* estabelecer ligação à BD */
    require_once '../../conexao.php';
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à Base de Dados ($code $message)!";
    } else {
      /* executar query... */
      $query = "INSERT INTO diaaberto (titulo, data1, horas, id_prof) VALUES ('" . $titulo . "', '" . $data1 . "', '" . $horas . "', '" . $id_prof . "');";
      $sucesso_query = mysqli_query($conn, $query);
      if ($sucesso_query) {
        if ($conn->affected_rows > 0) {
          $_SESSION["message"] = array(
            "content" => "O Dia aberto <b>" .  $titulo . "</b> foi criado com sucesso!",
            "type" => "success",
          );
        } else {
          $_SESSION["message"] = array(
            "content" => "Ocorreu um erro ao criar o dia aberto <b>" . $titulo . "</b>!",
            "type" => "danger",
          );
        }
        header("Location: showaula.php");
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
  <title>Dashboard - Dia aberto</title>
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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span class="mdi mdi-times"></span>
            </button>
          </div>
        <?php
          unset($_SESSION["message"]);
        }
        ?>
        <div class="card">
          <div class="card-body">
            <h4 class="header-title">Criar Aula</h4>
            <br>
            <form action="createaula.php" method="POST">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputdata1">Data</label>
                  <input type="date" class="form-control" name="inputdata1" id="inputdata1" rows="2" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputtitulo">Titulo</label>
                  <input type="text" class="form-control" name="inputtitulo" id="inputtitulo" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputhoras">Horas</label>
                  <input type="text" class="form-control" name="inputhoras" id="inputhoras" required></input>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputid_prof">Escolher Professor</label>
                  <select name="inputid_prof" id="inputid_prof" class="form-control" required>
                    <?php
                    $sql = "SELECT * FROM professor;";
                    $resultProfessor = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($resultProfessor)) {
                      foreach ($row as $res => $key) {
                        $id_prof = $row['id_prof'];
                        $nome = $row['nome'];
                      }
                      echo "<option value='$id_prof'>$nome</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row justify-content-end">
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="showaula.php"><input type="button" value="Voltar" class="btn btn-primary" style="margin-left: 10px;"></a>
              </div>
            </form>
          </div>
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
      <script src="assets/js/validation.js"></script>
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
      <script>
        document.getElementById('inputdata1').addEventListener('change', function() {
          var date = new Date(this.value);
          var days = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
          var dayOfWeek = days[date.getDay()];
          document.getElementById('inputtitulo').value = dayOfWeek;
        });
      </script>
</body>

</html>